<?= $this->form_builder->open_form(array('action' => '')); ?>



<?
echo $this->form_builder->build_form_horizontal(
        array(
    array(
        'id' => 'id',
        'type' => 'hidden',
        'value' => ''
    ),
    array(/* INPUT */
        'id' => 'color',
        'placeholder' => 'Item Color',
        'input_addons' => array(
            'pre' => 'color: #fff',
            'post' => ''
        ),
        'help' => 'this is a help block'
    ),
    array(/* DROP DOWN */
        'id' => 'published',
        'type' => 'dropdown',
        'options' => array(
            '1' => 'Published',
            '2' => 'Disabled'
        )
    ),
    array(/* TEXTAREA */
        'id' => 'description',
        'type' => 'textarea',
        'class' => 'wysihtml5',
        'placeholder' => 'Item Description (HTML or rich text)',
        'value' => ''
    ),
    array(
        'id' => 'experation_date',
        'type' => 'combine', /* use `combine` to put several input inside the same block */
        'elements' => array(
            array(
                'id' => 'cc_exp_month',
                'label' => 'Expiration Date',
                'autocomplete' => 'cc-exp-month',
                'type' => 'dropdown',
                'options' => '',
                'class' => 'required input-small',
                'required' => '',
                'data-items' => '4',
                'pattern' => '',
                'style' => 'width: auto;',
                'value' => ''
            ),
            array(
                'id' => 'cc_exp_year',
                'label' => 'Expiration Date',
                'autocomplete' => 'cc-exp-year',
                'type' => 'dropdown',
                'options' => '',
                'class' => 'required input-small',
                'required' => '',
                'data-items' => '4',
                'pattern' => '',
                'style' => 'width: auto; margin-left: 5px;',
                'value' => ''
            )
        )
    ),
    array(
        'id' => 'submit',
        'type' => 'submit'
    )
        ));
?>


<?= $this->form_builder->close_form(); ?>
