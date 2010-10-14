<?php $this->load->helper('language'); ?>
<ol>
    <table class="_main_master_table">
        <tr>
            <td>
            <?php echo "<div class='_header'>" . $modelname_short . 
                                    "</div><br /><br />";?>
            <table class="_master_table">

            <?php if ( VERBOSE ) {?>
                <tr>
                    <td>Show Only Failing Unit Tests:</td>
                    <td><input type="checkbox" value="should_hide"
                        onclick="_hide_show_success( this.checked );" /></td>
                </tr>
                <?php }?>
                <tr>
                    <td>
                    <button id="_expand_close_button" value="expand"
                        onclick="_expand_close_all( this );">+ Expand All
                    <button>
                    
                    </td>
                </tr>
            </table>

            <br />

            <?php

            $total_successful_utests = 0;
            $total_failing_utests = 0;
            $i=0;
            foreach ($results as $result):
            ?>

            <table id="_test_case_<?php echo $i;?>" border="1" name="test_case_tables">

                <tr name="_test_cases">
                    <td class="_openclose"
                        onmouseover="this.style.cursor='pointer';"
                        onclick="_open_close(this.parentNode.parentNode.parentNode );">+</td>

                        <?php if ($result[lang('ut_result')] == lang('ut_passed')): ?>

                    <td class="_pas" id="_unit_test_<?php echo $i;?>">[<?php echo strtoupper(lang('ut_passed'));?>]<br />
                    <?php echo $result[lang('ut_test_name')];?><?php else: ?>

                    <td class="_err" id="_unit_test_<?php echo $i;?>">[<?php echo strtoupper(lang('ut_failed'));?>]<br />
                    <?php echo '<a name="' . $utest_status[$i][ 'failing_test_names' ]  . '" /a>' . $result[lang('ut_test_name')];?><?php endif; ?>
                    <?php
                    $total_successful_utests +=
                    $utest_status[$i][ 'num_of_passing_utests' ];
                    $total_failing_utests +=
                    $utest_status[$i][ 'num_of_failing_utests' ];

                    echo "<br />Passing: " .
                    $utest_status[$i][ 'num_of_passing_utests' ];
                    echo "<br />Failing: " .
                    $utest_status[$i][ 'num_of_failing_utests' ];
                    ?></td>
                
                </tr>

                <?php $j=0; foreach ($messages[$i] as $message): ?>

                <tr
                <?php if ($message[0]) { echo 'class="_assert_pas" name="_success"'; } else { echo 'class="_assert_err"'; } ?>>
                    <td><?php echo $j + 1; ?></td>
                    <td><?php echo $message[1];?></td>
                </tr>

                <?php $j++; endforeach; ?>

            </table>

            <br />

            </li>
            <br />
            <?php $i++; endforeach;

            //Draw the table graphs

            $max_bar_length = 120;
            ?>

            <table class="_master_table" border=0>
                <tr class="_table_header">
                    <td class="_top_header_text">Test Case Status</td>
                    <td width="20">&nbsp;</td>
                    <td class="_right_header_text">%</td>
                </tr>

                <tr class="_failure_header">
                    <td class="_left_header_text">Failures: <?php echo $total_failing_utests;?>
                    </td>
                    <td width="20">&nbsp;</td>
                    <td class="_left_header_text">                    
                        <?php
                        $total_utests = $total_successful_utests
                                            + $total_failing_utests;
                        $num_of_fail_bars = ceil( $total_failing_utests / $total_utests );
                        $num_of_passing_bars = $max_bar_length - $num_of_fail_bars;
                        
                        for( $i = 0; $i < $num_of_fail_bars; $i++ )
                        {
                            echo "|";
                        }                    
                        ?>
                    </td>
                </tr>

                <tr class="_success_header">
                    <td class="_left_header_text">Passing: <?php echo $total_successful_utests;?></td>
                    <td width="20">&nbsp;</td>
                    <td class="_left_header_text">
                        <?php
                        for( $i = 0; $i < $num_of_passing_bars; $i++ )
                        {
                            echo "|";
                        }
                        ?>
                    </td>
                </tr>
            </table>

            </td>
        </tr>
    </table>
</ol>
<br />
