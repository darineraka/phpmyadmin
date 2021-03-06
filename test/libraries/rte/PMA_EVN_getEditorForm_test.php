<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Test for generating event editor
 *
 * @package PhpMyAdmin-test
 */

require_once 'libraries/php-gettext/gettext.inc';
require_once 'libraries/url_generating.lib.php';
require_once 'libraries/Util.class.php';
/*
 * Include to test.
 */
require_once 'libraries/rte/rte_events.lib.php';

/**
 * Test for generating event editor
 *
 * @package PhpMyAdmin-test
 */
class PMA_EVN_GetEditorForm_Test extends PHPUnit_Framework_TestCase
{
    /**
     * Set up
     *
     * @return void
     */
    public function setUp()
    {
        $GLOBALS['tear_down']['server'] = false;
        if (! isset($GLOBALS['cfg']['ServerDefault'])) {
            $GLOBALS['cfg']['ServerDefault'] = '';
            $GLOBALS['tear_down']['server'] = true;
        }
    }

    /**
     * Tear down
     *
     * @return void
     */
    public function tearDown()
    {
        if ($GLOBALS['tear_down']['server']) {
            unset($GLOBALS['cfg']['ServerDefault']);
        }
        unset($GLOBALS['tear_down']);
    }

    /**
     * Test for PMA_EVN_getEditorForm
     *
     * @param array $data    Data for routine
     * @param array $matcher Matcher
     *
     * @return void
     *
     * @dataProvider providerAdd
     */
    public function testgetEditorFormAdd($data, $matcher)
    {
        $GLOBALS['is_ajax_request'] = false;
        PMA_EVN_setGlobals();
        $this->assertTag(
            $matcher,
            PMA_EVN_getEditorForm('add', 'change', $data),
            '',
            false
        );
    }

    /**
     * Data provider for testgetEditorFormAdd
     *
     * @return array
     */
    public function providerAdd()
    {
        $data = array(
            'item_name'           => '',
            'item_type'           => 'ONE TIME',
            'item_type_toggle'    => 'RECURRING',
            'item_original_name'  => '',
            'item_status'         => '',
            'item_execute_at'     => '',
            'item_interval_value' => '',
            'item_interval_field' => '',
            'item_starts'         => '',
            'item_ends'           => '',
            'item_definition'     => '',
            'item_preserve'       => '',
            'item_comment'        => '',
            'item_definer'        => ''
        );

        return array(
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'add_item'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_name'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'select',
                    'attributes' => array(
                        'name' => 'item_status'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_type'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_changetype'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_execute_at'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_interval_value'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'select',
                    'attributes' => array(
                        'name' => 'item_interval_field'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_starts'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_ends'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'textarea',
                    'attributes' => array(
                        'name' => 'item_definition'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_preserve'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_definer'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_comment'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'editor_process_add'
                    )
                )
            )
        );
    }

    /**
     * Test for PMA_EVN_getEditorForm
     *
     * @param array $data    Data for routine
     * @param array $matcher Matcher
     *
     * @return void
     *
     * @dataProvider providerEdit
     */
    public function testgetEditorFormEdit($data, $matcher)
    {
        $GLOBALS['is_ajax_request'] = false;
        PMA_EVN_setGlobals();
        $this->assertTag(
            $matcher,
            PMA_EVN_getEditorForm('edit', 'change', $data),
            '',
            false
        );
    }

    /**
     * Data provider for testgetEditorForm_edit
     *
     * @return array
     */
    public function providerEdit()
    {
        $data = array(
            'item_name'           => 'foo',
            'item_type'           => 'RECURRING',
            'item_type_toggle'    => 'ONE TIME',
            'item_original_name'  => 'bar',
            'item_status'         => 'ENABLED',
            'item_execute_at'     => '',
            'item_interval_value' => '1',
            'item_interval_field' => 'DAY',
            'item_starts'         => '',
            'item_ends'           => '',
            'item_definition'     => 'SET @A=1;',
            'item_preserve'       => '',
            'item_comment'        => '',
            'item_definer'        => ''
        );

        return array(
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'edit_item'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_name'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'select',
                    'attributes' => array(
                        'name' => 'item_status'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_type'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_changetype'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_execute_at'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_interval_value'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'select',
                    'attributes' => array(
                        'name' => 'item_interval_field'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_starts'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_ends'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'textarea',
                    'attributes' => array(
                        'name' => 'item_definition'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_preserve'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_definer'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'item_comment'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'editor_process_edit'
                    )
                )
            )
        );
    }

    /**
     * Test for PMA_EVN_getEditorForm
     *
     * @param array $data    Data for routine
     * @param array $matcher Matcher
     *
     * @return void
     *
     * @dataProvider providerAjax
     */
    public function testgetEditorFormAjax($data, $matcher)
    {
        $GLOBALS['is_ajax_request'] = true;
        PMA_EVN_setGlobals();
        $this->assertTag(
            $matcher,
            PMA_EVN_getEditorForm('edit', 'change', $data),
            '',
            false
        );
    }

    /**
     * Data provider for testgetEditorForm_ajax
     *
     * @return array
     */
    public function providerAjax()
    {
        $data = array(
            'item_name'           => '',
            'item_type'           => 'RECURRING',
            'item_type_toggle'    => 'ONE TIME',
            'item_original_name'  => '',
            'item_status'         => 'ENABLED',
            'item_execute_at'     => '',
            'item_interval_value' => '',
            'item_interval_field' => 'DAY',
            'item_starts'         => '',
            'item_ends'           => '',
            'item_definition'     => '',
            'item_preserve'       => '',
            'item_comment'        => '',
            'item_definer'        => ''
        );

        return array(
            array(
                $data,
                array(
                    'tag' => 'select',
                    'attributes' => array(
                        'name' => 'item_type'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'editor_process_edit'
                    )
                )
            ),
            array(
                $data,
                array(
                    'tag' => 'input',
                    'attributes' => array(
                        'name' => 'ajax_request'
                    )
                )
            )
        );
    }
}
?>
