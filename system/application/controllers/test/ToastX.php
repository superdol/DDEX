<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ToastX
 *
 * Unit testing in CodeIgniter. Requires PHP 4. Subclass
 * this class to create your own tests. See the README file or go to
 * http://toastx.sourceforge.net/ for usage and examples.
 *
 * @package            CodeIgniter
 * @subpackage         Controllers
 * @category           Unit Testing
 * @license            Public Domain
 * @ToastX author      Louis Casillas, (oxaric@gmail.com)
 * @Toast author       Jens Roland (mail@jensroland.com)
 *
 */

// set to 1 to return all passing and failing unit tests
// otherwise only failing unit tests will be returned
define('VERBOSE', 1);

// set to 1 to print all ToastX debug messages
// NOTICE: only set to 1 if you want to test individual test case files
// otherwise echoing a debug statement while trying to run all tests
// will mess up the curl calls and usually return nothing.
define('DEBUG', 0);

class ToastX extends Controller
{
    // The folder INSIDE /controllers/ where the test classes are located
    var $test_dir = '/test/';

    var $modelname;
    var $modelname_short;
    var $message;
    var $messages;
    var $asserts;

    var $num_of_passing_utests;
    var $num_of_failing_utests;

    // Files to skip (ie. non-test classes) inside the test dir
    var $skip = array(
    'ToastX.php',
    'forms.php',
    'example_tests.php',
    'selenium.php'
    );

    function ToastX($name = NULL)
    {
        if ( DEBUG )
        {
            echo "ToastX Constructor<br /><br />";
        }

        parent::Controller();

        $this->load->library('unit_test');
        $this->modelname = $name;
        $this->modelname_short = basename($name, '.php');
        $this->messages = array();
        $this->utest_status = array();
    }

    function index()
    {
        if ( DEBUG )
        {
            echo "index()<br /><br />";
        }

        //The ToastX.php file is being accessed directly 
        //so run all the ToastX tests in the current directory.
        if ( $this->modelname == NULL )
        {
            if ( DEBUG )
            {
                echo "modelname == NULL<br /><br />";
            }

            $output = '';
            
            // Fetch all test classes
            $test_files = $this->_get_test_files();

            // Build array of full test URLs
            $this->load->helper('url');

            $test_urls = array();

            foreach ($test_files as $file)
            {
                $test_urls[] = site_url($this->test_dir . $file . '/show_results');
            }

            $test_response = $this->_curl_get($test_urls);
            
            $output .= $test_response[ 'html' ];

            if ( DEBUG )
            {
                echo "Load Header<br /><br />";
            }
            
            if ( isset($test_response[ 'failing_test_names' ]) )
            {
                $test_response[ 'total_test_results' ][ 'failing_test_names' ] = $test_response[ 'failing_test_names' ][ 0 ];
            }
            
            $total_test_results = $test_response[ 'total_test_results' ];
            
            // Load header
            $output = $this->load->view('test/header', $total_test_results, TRUE) . $output;

            if ( DEBUG )
            {
                echo "Load Footer<br /><br />";
            }

            // Load footer
            $output .= $this->load->view('test/footer', NULL, TRUE);

            // Send all output to the browser
            echo $output;
            
        } // end check for NULL $name
        else
        {
            $this->_show_all();
        }
    }

    // This function is called if a user is attempting to run all ToastX
    // test case files.
    // Example: [WEB ADDRESS]/test/ToastX
    function show_results()
    {
        if ( DEBUG )
        {
            echo "show_results()<br /><br />";
        }

        $total_test_results = $this->_run_all();
                      
        $data['modelname'] = $this->modelname;
        $data['modelname_short'] = $this->modelname_short;
        $data['results'] = $this->unit->result();
        $data['messages'] = $this->messages;
        $data['utest_status'] = $this->utest_status;
        $data['failing_test_names'] = $total_test_results[ 'failing_test_names' ];
        
        $results_view = $this->load->view('test/results', $data, TRUE);
        
        $response = array( 'html'=> $results_view,
                          'total_test_results'=> $total_test_results,
                          'failing_test_names'=> 
                          $total_test_results[ 'failing_test_names' ]);

        echo json_encode($response);
    }

    // This function is called if a user is attempting to access a specific
    // test case file.
    // Example: [WEB ADDRESS]/test/test_case_file_name
    function _show_all()
    {
        if ( DEBUG )
        {
            echo "_show_all()<br /><br />";
        }

        $total_test_results = $this->_run_all();

        $this->load->view('test/header', $total_test_results);
        
        $data['modelname'] = $this->modelname;
        $data['modelname_short'] = $this->modelname_short;
        $data['results'] = $this->unit->result();
        $data['messages'] = $this->messages;
        $data['utest_status'] = $this->utest_status;
        $data['failing_test_names'] = $total_test_results[ 'failing_test_names' ];

        $this->load->view('test/results', $data);
        $this->load->view('test/footer');
    }

    // This function is called if a user is attempting to access a specific
    // unit test function in a specific test case file.
    // Example: [WEB ADDRESS]/test/test_case_file_name/unit_test_function_name
    function _show($method)
    {
        if ( DEBUG )
        {
            echo "_show()<br /><br />";
        }

        $total_test_results = $this->_run($method);
        $total_test_results = $total_test_results[ 0 ];
        $total_test_results = array('total_passing_utests' =>
                                $total_test_results['num_of_passing_utests'],
                                'total_failing_utests' =>
                                $total_test_results['num_of_failing_utests'],
                                'failing_test_names' => 
                                $total_test_results[ 'failing_test_names' ]);

        $this->load->view('test/header', $total_test_results);

        $data['modelname'] = $this->modelname;
        $data['modelname_short'] = $this->modelname_short;
        $data['results'] = $this->unit->result();
        $data['messages'] = $this->messages;
        $data['utest_status'] = $this->utest_status;
        $data['failing_test_names'] = $total_test_results[ 'failing_test_names' ];

        $this->load->view('test/results', $data);
        $this->load->view('test/footer');
    }

    function _run_all()
    {
        if ( DEBUG )
        {
            echo "_run_all()<br /><br />";
        }

        $total_passing_utests = 0;
        $total_failing_utests = 0;
        
        $failing_test_names = array();
        $count = 0;
        
        $i = 0;
        foreach ($this->_get_test_methods() as $method)
        {
            
            $run_results = $this->_run($method);
            $results = $run_results[ $i ];
            
            $total_passing_utests += $results[ 'num_of_passing_utests' ];
            $total_failing_utests += $results[ 'num_of_failing_utests' ];
            
            if ($results[ 'num_of_failing_utests' ] > 0)
            {
                $failing_test_names[ $count ] = $results[ 'failing_test_names' ];
                $count++;
            }
            
            $i++;
        }

        $total_test_results = array('total_passing_utests' =>
                                $total_passing_utests,
                                'total_failing_utests' =>
                                $total_failing_utests,
                                'failing_test_names' =>
                                $failing_test_names);
        
        return $total_test_results;
    }

    function _run($method)
    {
        if ( DEBUG )
        {
            echo "_run()<br /><br />";
        }

        // Reset unit test messages for each test case
        $this->unit_test_results = array();

        $this->num_of_passing_utests = 0;
        $this->num_of_failing_utests = 0;

        // Reset asserts
        $this->asserts = TRUE;

        // Run cleanup method _pre
        $this->_pre();

        // Run test case (result will be in $this->asserts)
        $this->$method();

        // Run cleanup method _post
        $this->_post();

        $this->messages[] = $this->unit_test_results;

        if ($this->num_of_failing_utests > 0)
        {
            $this->utest_status[] = array('num_of_passing_utests' =>
                                          $this->num_of_passing_utests,
                                          'num_of_failing_utests' =>
                                          $this->num_of_failing_utests,
                                          'failing_test_names' =>
                                          $this->modelname_short . ' -> ' .substr($method, 5));
        }
        else
        {
            $this->utest_status[] = array('num_of_passing_utests' =>
                                          $this->num_of_passing_utests,
                                          'num_of_failing_utests' =>
                                          $this->num_of_failing_utests,
                                          'failing_test_names' => "");
        }
        
        // Set test description to "model name -> method name" with links
        $this->load->helper('url');
        $test_class_segments = $this->test_dir . strtolower($this->modelname_short);
        $test_method_segments = $test_class_segments . '/' . substr($method, 5);
        $desc = anchor($test_class_segments, $this->modelname_short) . ' -> ' . anchor($test_method_segments, substr($method, 5));

        // Pass the test case to CodeIgniter
        $this->unit->run($this->asserts, TRUE, $desc);
        
        return $this->utest_status;
    }

    /**
     * Get a list of all the test files in the test dir
     *
     * @return array of filenames (without '.php' extensions)
     */
    function _get_test_files()
    {

        if ( DEBUG )
        {
            echo "_get_test_files()<br /><br />";
        }

        $files = array();

        $handle=opendir(APPPATH . '/controllers' . $this->test_dir);
        while (false!==($file = readdir($handle)))
        {
            // Skip hidden/system files and the files in the skip[] array
            if ( ! in_array($file, $this->skip) && ! (substr($file, 0, 1) == '.'))
            {
                // Remove the '.php' part of the file name
                $files[] = substr($file, 0, strlen($file) - 4);
            }
        }
        closedir($handle);
        return $files;
    }

    /**
     * Fetch a number of URLs as a string
     *
     * @return string containing the (concatenated) HTML documents
     * @param array $urls array of fully qualified URLs
     */
    function _curl_get($urls)
    {
        if ( DEBUG )
        {
            echo "_curl_get()<br /><br />";
        }

        $html_str = '';
        
        $total_passing_utests = 0;
        $total_failing_utests = 0;
        $count = 0;
        
        foreach ($urls as $url)
        {
            $curl_handle=curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, $url);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            $test_results_response = json_decode( curl_exec($curl_handle), true );
            curl_close($curl_handle);
            
            $html_str .= $test_results_response[ 'html' ];
             
            $total_passing_utests += $test_results_response[ 'total_test_results' ][ 'total_passing_utests' ];
            $total_failing_utests += $test_results_response[ 'total_test_results' ][ 'total_failing_utests' ];
            
            if (count($test_results_response[ 'failing_test_names' ]) > 0)
            {
                $failing_test_names[ $count ] = $test_results_response[ 'failing_test_names' ];
                $count++;
            }
        }
        
        $total_test_results = array('total_passing_utests' =>
                                    $total_passing_utests,
                                    'total_failing_utests' =>
                                    $total_failing_utests);
        if ($count > 0)
        {
            $full_curl_result = array('html' => $html_str,
                                  'total_test_results' => 
                                  $total_test_results,
                                  'failing_test_names' => 
                                  $failing_test_names); 
        }
        else
        {
            $full_curl_result = array('html' => $html_str,
                                  'total_test_results' => 
                                  $total_test_results);
        }

        return $full_curl_result;
    }
    
    function _get_test_methods()
    {
        if ( DEBUG )
        {
            echo "_get_test_methods()<br /><br />";
        }

        $methods = get_class_methods($this);
        $testMethods = array();

        foreach ($methods as $method) {
            if (substr(strtolower($method), 0, 5) == 'test_') {
                $testMethods[] = $method;
            }
        }

        return $testMethods;
    }

    /**
     * Remap function (CI magic function)
     *
     * Reroutes any request that matches a test function in the subclass
     * to the _show() function.
     *
     * This makes it possible to request /my_test_class/my_test_function
     * to test just that single function, and /my_test_class to test all the
     * functions in the class.
     *
     */
    function _remap($method)
    {
        if ( DEBUG )
        {
            echo "_remap()<br /><br />";
        }

        $test_name = 'test_' . $method;
        if (method_exists($this, $test_name))
        {
            $this->_show($test_name);
        }
        else
        {
            $this->$method();
        }
    }

    /**
     * Cleanup function that is run before each test case
     * Override this method in test classes!
     */
    function _pre() {

    }

    /**
     * Cleanup function that is run after each test case
     * Override this method in test classes!
     */
    function _post() {

    }

/**********************************
ASSERTS
***********************************/

    function _document_unit_test( $did_pass, $result_message, $__trace = NULL )
    {
        $this->message = array();

        $this->message[0] = $did_pass;
        $this->message[1] = $result_message;

        if ( ! $did_pass )
        {
            $this->num_of_failing_utests++;

            $this->message[1] = $result_message .
                                ",<br />File: " .
            $__trace[0]['file'] .
                                "<br />Line: " . $__trace[0]['line'];
        }
        else
        {
            $this->num_of_passing_utests++;

            $this->message[1] = $result_message .
                                ",<br />File: " .
            $__trace[0]['file'] .
                                "<br />Line: " . $__trace[0]['line'];
        }

        $this->unit_test_results[] = $this->message;
    }

    // if the object is a stdClass then trying to use __toString will
    // throw an exception so json_encode the stdClass object to get
    // some meaningful output
    function _check_for_std_class( $assertion )
    {
        if ( is_a( $assertion, 'stdClass' ) )
        {
            $assertion = json_encode( $assertion  );
        }

        return $assertion;
    }

    function _assert_true($assertion) {

        if ($assertion) {
             
            if ( VERBOSE )
            {
                $assertion = $this->_check_for_std_class( $assertion );

                $this->_document_unit_test( TRUE,
                    "Passed: Asserting True (TRUE == $assertion)", 
                                               debug_backtrace() );
            }
            else
            {
                $this->num_of_passing_utests++;
            }

            return TRUE;
        } else {

            $this->_document_unit_test( FALSE,
                "Failed: Asserting True (TRUE == FALSE)", 
                                      debug_backtrace() );

            $this->asserts = FALSE;

            return FALSE;
        }
    }

    function _assert_false($assertion) {

        if($assertion) {

            $assertion = $this->_check_for_std_class( $assertion );

            $this->_document_unit_test( FALSE,
                "Failed: Asserting False (FALSE == $assertion)", 
                                             debug_backtrace() );

            $this->asserts = FALSE;

            return FALSE;
        } else {

            if ( VERBOSE )
            {
                $this->_document_unit_test( TRUE,
                            "Passed: Asserting False (FALSE == FALSE)", 
                                                    debug_backtrace() );
            }
            else
            {
                $this->num_of_passing_utests++;
            }

            return TRUE;
        }
    }

    function _assert_equals($base, $check) {

        if($base == $check) {

            if ( VERBOSE )
            {

                $base = $this->_check_for_std_class( $base );
                $check = $this->_check_for_std_class( $check );

                $this->_document_unit_test( TRUE,
                    "Passed: Asserting Equals ($base == $check)", 
                                              debug_backtrace() );
            }
            else
            {
                $this->num_of_passing_utests++;
            }

            return TRUE;
        } else {

            $base = $this->_check_for_std_class( $base );
            $check = $this->_check_for_std_class( $check );

            $this->_document_unit_test( FALSE,
                "Failed: Asserting Equals ($base == $check)", 
                                          debug_backtrace() );
            $this->asserts = FALSE;

            return FALSE;
        }
    }

    function _assert_not_equals($base, $check) {

        if($base != $check) {

            if ( VERBOSE )
            {
                $base = $this->_check_for_std_class( $base );
                $check = $this->_check_for_std_class( $check );

                $this->_document_unit_test( TRUE,
                    "Passed: Asserting Not Equals ($base != $check)", 
                                                  debug_backtrace() );
            }
            else
            {
                $this->num_of_passing_utests++;
            }

            return TRUE;
        } else {

            $base = $this->_check_for_std_class( $base );
            $check = $this->_check_for_std_class( $check );

            $this->_document_unit_test( FALSE,
                "Failed: Asserting Not Equals ($base != $check)", 
                                              debug_backtrace() );

            $this->asserts = FALSE;

            return FALSE;
        }
    }

    function _assert_is_a($base, $check) {

        $type = gettype($base);

        if($type == trim($check)) {

            if ( VERBOSE )
            {

                $base = $this->_check_for_std_class( $base );
                $check = $this->_check_for_std_class( $check );

                $this->_document_unit_test( TRUE,
                    "Passed: Asserting IS A ($base IS A $check)",
                                              debug_backtrace() );
            }
            else
            {
                $this->num_of_passing_utests++;
            }

            return TRUE;
        } else {

            $base = $this->_check_for_std_class( $base );
            $check = $this->_check_for_std_class( $check );

            $this->_document_unit_test( FALSE,
                "Failed: Asserting IS A ($base IS A $check)", 
                                          debug_backtrace() );
            $this->asserts = FALSE;

            return FALSE;
        }
    }

    function _assert_empty($assertion) {

        if(empty($assertion)) {

            if ( VERBOSE )
            {

                $assertion = $this->_check_for_std_class( $assertion );

                $this->_document_unit_test( TRUE,
                    "Passed: Asserting Empty ( empty($assertion) )", 
                                                 debug_backtrace() );
            }
            else
            {
                $this->num_of_passing_utests++;
            }

            return TRUE;
        } else {

            $assertion = $this->_check_for_std_class( $assertion );

            $this->_document_unit_test( FALSE,
                "Failed: Asserting Empty ( empty($assertion) )", 
                                             debug_backtrace() );
            $this->asserts = FALSE;

            return FALSE;
        }
    }

    function _assert_not_empty($assertion) {

        if(!empty($assertion)) {

            if ( VERBOSE )
            {
                $assertion = $this->_check_for_std_class( $assertion );

                $this->_document_unit_test( TRUE,
                "Passed: Asserting Not Empty ( ! empty($assertion) )",
                                                   debug_backtrace() );
            }
            else
            {
                $this->num_of_passing_utests++;
            }

            return TRUE;
        } else {
            $this->_document_unit_test( FALSE,
                "Failed: Asserting Not Empty ( ! empty( NULL ) )", 
            debug_backtrace() );

            $this->asserts = FALSE;

            return FALSE;
        }
    }

/***** Strict Assrtions *****/

    function _assert_true_strict($assertion) {

        if ($assertion === TRUE) {
             
            if ( VERBOSE )
            {
                $assertion = $this->_check_for_std_class( $assertion );

                $this->_document_unit_test( TRUE,
                    "Passed: Asserting Strict True (TRUE === $assertion)", 
                                               debug_backtrace() );
            }
            else
            {
                $this->num_of_passing_utests++;
            }

            return TRUE;
        } else {

            $this->_document_unit_test( FALSE,
                "Failed: Asserting Strict True (TRUE === FALSE)", 
                                      debug_backtrace() );

            $this->asserts = FALSE;

            return FALSE;
        }
    }

    function _assert_false_strict($assertion) {

        if($assertion === FALSE ) {

            $assertion = $this->_check_for_std_class( $assertion );

            $this->_document_unit_test( FALSE,
                "Failed: Asserting Strict False (FALSE === $assertion)", 
                                             debug_backtrace() );

            $this->asserts = FALSE;

            return FALSE;
        } else {

            if ( VERBOSE )
            {
                $this->_document_unit_test( TRUE,
                            "Passed: Asserting Strict False (FALSE === FALSE)", 
                                                    debug_backtrace() );
            }
            else
            {
                $this->num_of_passing_utests++;
            }

            return TRUE;
        }
    }	
	
    function _assert_equals_strict($base, $check) {

        if($base === $check) {

            if ( VERBOSE )
            {

                $base = $this->_check_for_std_class( $base );
                $check = $this->_check_for_std_class( $check );

                $this->_document_unit_test( TRUE,
                    "Passed: Asserting Strict Equals ($base === $check)",
                                                      debug_backtrace() );
            }
            else
            {
                $this->num_of_passing_utests++;
            }

            return TRUE;
        } else {

            $base = $this->_check_for_std_class( $base );
            $check = $this->_check_for_std_class( $check );

            $this->_document_unit_test( FALSE,
                "Failed: Asserting Strict Equals ($base === $check)", 
                                                  debug_backtrace() );
            $this->asserts = FALSE;

            return FALSE;
        }
    }

    function _assert_not_equals_strict($base, $check) {

        if($base !== $check) {

            if ( VERBOSE )
            {

                $base = $this->_check_for_std_class( $base );
                $check = $this->_check_for_std_class( $check );

                $this->_document_unit_test( TRUE,
                    "Passed: Asserting Strict Not Equals ($base !== $check)",
                                                          debug_backtrace() );
            }
            else
            {
                $this->num_of_passing_utests++;
            }

            return TRUE;
        } else {

            $base = $this->_check_for_std_class( $base );
            $check = $this->_check_for_std_class( $check );

            $this->_document_unit_test( FALSE,
                "Failed: Asserting Strict Not Equals ($base !== $check)", 
                                                      debug_backtrace() );

            $this->asserts = FALSE;

            return FALSE;
        }
    }
	
}

// End of file ToastX.php
