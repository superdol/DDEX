<html>
<head>
<title>ToastX Unit test results</title>

<style type="text/css">

    ._main_master_table {
        font-family: Arial, sans-serif; 
        font-size: 10pt;
        border-spacing: 20px;
        border-width: 5px;
        border-color: lightblue;
        border-style: dashed;
        padding: 40px 40px 40px 40px;
    }

    ._master_table {
        border-spacing: 3px;
        border-width: 3px;
        border-color: lightblue;
        border-style: dashed;
        padding: 10px 10px 10px 10px;
    }

    ._test_results_table, ._test_results_fail, ._test_results_pass {
        font-family: Arial, sans-serif; 
        font-size: 10pt;
        border-spacing: 20px;
        border-width: 5px;
        border-color: black;
        border-style: dashed;
        padding: 40px 40px 40px 40px;
    }
    
    ._test_results_fail {
        background-color: red;
    }

    ._test_results_pass {
        background-color: green;
    }

    ._err, ._pas, ._assert_err, ._assert_pas, ._total_test_results { 
        color: yellow;
        font-weight: bold;
        margin: 2px 0;
        padding: 5px;
        vertical-align: top; 
    }
    
    ._err, ._assert_err { 
        background-color: red;
    }
    
    ._pas, ._assert_pas { 
        background-color: green;
    }

    ._assert_err, ._assert_pas {
        display: none;
    }
    
    ._openclose {
        text-align: center;   
        background-color: orange;
    }

    ._detail { 
        padding: 8px 0 8px 20px;
    }

    ._box_table {
        padding: 5px 5px 5px 5px;
        background-color: 63C6DE;
        border-spacing: 0px;
        font-size: 24pt;
        width: 500px;
    }
        
    ._table_header {
        width: 100px;
    }
    
    ._top_header_text {
        width: 100px;
        text-align: center;
    }

    ._left_header_text {
        width: 100px;
        text-align: left;
    }

    ._right_header_text {
        text-align: center;
    }
    
    ._success_header {
        background-color: green;
    }
    
    ._failure_header {
        background-color: red;
    }
    
    ._marks {
        color: blue;
    }
    
    ._header { 
        font-size: 13pt;
        font-weight: bold;
        color: blue;
        text-align:center;
    }
    
    ._title {
        font-size: 18pt;
        font-weight: bold;
        color: blue;
        text-align:left;
    }
    
    ._toast_body a:link, ._toast_body a:visited { 
        text-decoration: none;
        color: lightyellow;
    }
    
    ._toast_body a:hover, ._toast_body a:active {
        text-decoration: none;
        color: black;
        background-color: yellow;
    }
    
</style>

<script type="text/javascript">

   function _expand_close_all( _button_object )
   {
       _all_test_case_tables = document.getElementsByName( 'test_case_tables' );
       
       for ( var i = 0; i < _all_test_case_tables.length; i++)
       {
            if ( _button_object.value == "expand" )
            {
                _all_test_case_tables[ i ].is_closed = 'TRUE';
            }
            else
            {
                _all_test_case_tables[ i ].is_closed = 'FALSE';
            }

            _open_close( _all_test_case_tables[ i ] );

       }

       if ( _button_object.value == "expand" )
       {
                _button_object.value = "close";
       }
       else
       {
                _button_object.value = "expand";
       }

       if ( _button_object.value == "close" )
       {
           _button_object.innerHTML = "- Close All";            
       }
       else
       {
           _button_object.innerHTML = "+ Expand All";
       }
   }
   
   function _open_close( _table_var )
   {
       if ( _table_var.is_closed == undefined || _table_var.is_closed == 'TRUE')
       {
           //if closed then open
           _set_table_open( _table_var );
           
           for ( var i = 1; i < _table_rows.length; i++)
           {
               if ( _table_rows[ i ].hide == undefined || 
                    _table_rows[ i ].hide == 'FALSE' )
               {
                   _table_rows[ i ].style.display = 'table-row';
               }
           }
       }
       else
       {
           //open so close
           _set_table_close( _table_var );

           for ( var i = 1; i < _table_rows.length; i++)
           {
               _table_rows[ i ].style.display = 'none';
           }

       }
   }
   
   function _set_table_open( _table_var )
   {
         _table_var.is_closed = 'FALSE';
         _table_rows = _table_var.getElementsByTagName( 'tr' );
         _first_row_elements = _table_rows[0].getElementsByTagName( 'td' );
         _first_row_elements[0].innerHTML = '-';
         
   }

   function _set_table_close( _table_var )
   {
           _table_var.is_closed = 'TRUE';
           _table_rows = _table_var.getElementsByTagName( 'tr' );
           _first_row_elements = _table_rows[0].getElementsByTagName( 'td' );
           _first_row_elements[0].innerHTML = '+';
   }
   
   <?php if ( VERBOSE ) {?>
    
   function _hide_show_success( _should_hide_successful_utests )
   {
       _successful_unit_tests = document.getElementsByName( '_success' );
        
        // hide success unit tests
        if ( _should_hide_successful_utests )
        {   
           for ( var i = 0; i < _successful_unit_tests.length; i++ )
           {
                _successful_unit_tests[ i ].style.display = 'none';
                _successful_unit_tests[ i ].hide = 'TRUE';
           }
        }
        else
        {
            // show all unit tests
           for ( var i = 0; i < _successful_unit_tests.length; i++ )
           {
                _parent_table = _successful_unit_tests[ i ].parentNode.parentNode;
           
                if ( _parent_table.is_closed == 'FALSE' )
                {
                    _successful_unit_tests[ i ].style.display = 'table-row';
                }
                
                _successful_unit_tests[ i ].hide = 'FALSE';
           }
        }
   }

   <?php }?>
   
</script>

</head>

<body class="_toast_body">

<div class="_title">ToastX Unit Tests:</div>
<br />
<br />
<ol>

<?php
    if ($total_failing_utests > 0)
    {
        echo '<table class="_test_results_fail">';
    }
    else
    {
        echo '<table class="_test_results_pass">';
    }
?>

    <tr><td class="_total_test_results"><?php echo 'Total Tests Passed: '. 
                                            $total_passing_utests; ?></td></tr>
    <tr><td class="_total_test_results"><?php echo 'Total Tests Failed: '.
                                            $total_failing_utests; ?></td></tr>
    <?php
        if ($total_failing_utests > 0)
        {
            echo '<tr><td class="_header">Failing Tests:</td></tr>';

            if ($total_failing_utests == 1 && ! is_array($failing_test_names))
            {
                    echo '<tr><td><a href="#' . $failing_test_names . '">' . $failing_test_names . '</a></td></tr>';
            }
            else
            {
                foreach($failing_test_names as $test_name)
                {
                    echo '<tr><td><a href="#' . $test_name . '">' . $test_name . '</a></td></tr>';
                }
            }
        }
    ?>

</table>
</ol>
<br />
