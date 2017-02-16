$(function() {
    // datatables
    altair_datatables.dt_default();
    altair_datatables.dt_server();
    altair_datatables.dt_scroll();
    altair_datatables.dt_individual_search();
    altair_datatables.dt_colVis();
    altair_datatables.dt_formsubmission();
   // altair_datatables.dt_colsearch();
    altair_datatables.dt_tableTools();
});

altair_datatables = {
    dt_default: function() {
        var $dt_default = $('#dt_default');
        if($dt_default.length) {
            $dt_default.DataTable({
                'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [-1,-2],

                 /* 1st one, start by the right */
                 }],
                 "pageLength":11,
                /* "scrollY": "600px",
                "scrollCollapse": false,
                "paging": true,*/
                //"bSortCellsTop": true
            });
        }
    },
    dt_server: function() {
        var $dt_server = $('#dt_server');
        if($dt_server.length) {
            $dt_server.DataTable({
                'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [-1,-2],
                 /* 1st one, start by the right */
                 }],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: baseURL+"country/server",
                    type: 'GET'
                },
                "pageLength":12,
                "columns": [
                {
                    "className":"uk-text-center",
                },
                null,
                {
                    "className":"uk-text-center",
                },
                {
                    "className":"uk-text-center",
                }
                ], 
            });
        }
    },
    dt_scroll: function() {
        var $dt_scroll = $('#dt_scroll');
        if($dt_scroll.length) {
            $dt_scroll.DataTable({
                "scrollY": "200px",
                "scrollCollapse": false,
                "paging": false
            });
        }
    },
    dt_formsubmission: function() {
       var dt_formsubmission = $('#dt_formsubmission');
       // var default_country = $('body').data('default');
        //var selected = "selected";
        if(dt_formsubmission.length){
            dt_formsubmission.DataTable({
                initComplete: function () {
                    this.api().columns().every( function (i,j) {
                        if(i === 2){
                            var column = this;
                            var select = $('<select class="submission_filter uk-width-1-2" style="margin-right:10px"><option value="">Select Users</option></select>')
                                .prependTo( $('.dataTables_length')) 
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
             
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>')
                            });

                            var script = document.createElement("script");
                            script.type = "text/javascript";
                            script.innerHTML="$('.submission_filter').kendoDropDownList()";
                            $(".dataTables_length").append(script);
                        }
                    });
                },
                'aoColumnDefs': [{
        'bSortable': false,
        'aTargets': [-1] /* 1st one, start by the right */
    }]
            });
        }
    },
    dt_individual_search: function() {
        var $dt_individual_search = $('#dt_individual_search');
        if($dt_individual_search.length) {

            // Setup - add a text input to each footer cell
            $dt_individual_search.find('tfoot th').each( function() {
                var title = $dt_individual_search.find('tfoot th').eq( $(this).index() ).text();
                $(this).html('<input type="text" class="md-input" placeholder="' + title + '" />');
            } );

            // reinitialize md inputs
            altair_md.inputs();

            // DataTable
            var individual_search_table = $dt_individual_search.DataTable();

            // Apply the search
            individual_search_table.columns().every(function() {
                var that = this;

                $('input', this.footer()).on('keyup change', function() {
                    that
                        .search( this.value )
                        .draw();
                } );
            });

        }
    },
    dt_colVis: function() {
        var $dt_colVis = $('#dt_colVis');
        if($dt_colVis.length) {

            // init datatables
            var colVis_table = $dt_colVis.DataTable({
                'aoColumnDefs': [{
        'bSortable': false,
        'aTargets': [-1,-2] /* 1st one, start by the right */
    }]
            });

            // init colVis
            var colvis = new $.fn.dataTable.ColVis( colVis_table, {
                buttonText: 'Select columns',
                exclude: [ 0 ],
                restore: "Restore",
                showAll: "Show all",
                showNone: "Show none"
            });

            // custom colVis elements
            var _colVis_button = $(colvis.dom.button).off('click').attr('class','md-btn md-btn-colVis');
            var _colVis_wrapper = $('<div class="uk-button-dropdown uk-text-left" data-uk-dropdown="{mode:\'click\'}"/>').append(_colVis_button);
            var _colVis_wrapper_outer = $('<div class="md-colVis uk-text-right"/>').append(_colVis_wrapper);
            var _colVis_collection = $(colvis.dom.collection);

            // Modify colVis collection
            $(_colVis_collection)
                .attr({
                    'class': 'md-list-inputs',
                    'style': ''
                })
                .find('input')
                .each(function(index) {
                    var inputClone = $(this).clone().hide();
                    $(this).attr({
                        'class': 'data-md-icheck',
                        'id': 'col_' + index
                    }).css({
                        'float': 'left'
                    }).before(inputClone)
                })
                .end()
                .find('span').unwrap()
                .each(function() {
                    var thisText = $(this).text();
                    var thisInputId =  $(this).prev('input').attr('id');
                    $(this)
                        .after('<label for="' + thisInputId + '">' + thisText + '</label>')
                        .end()
                })
                .remove();

            // append collection to collection wrapper
            var _colVis_collection_wrapper = $('<div class="uk-dropdown uk-dropdown-flip"/>').append(_colVis_collection);

            // append collection wrapper to colVis wrapper
            _colVis_wrapper
                .append(_colVis_collection_wrapper);

            // insert colVis elements before datatable header
            $dt_colVis.closest('.dt-uikit').find('.dt-uikit-header').before(_colVis_wrapper_outer);

            // initialize styled checkboxes in dropdown
            altair_md.checkbox_radio();

            // custom events
            $dt_colVis.closest('.dt-uikit').find('.md-colVis .data-md-icheck').on('ifClicked',function() {
                $(this).closest('li').click();
            });

            $dt_colVis.closest('.dt-uikit').find('.md-colVis .ColVis_ShowAll,.md-colVis .ColVis_Restore').on('click',function() {
                $(this).closest('.uk-dropdown').find('.data-md-icheck').prop('checked',true).iCheck('update')
            });

            $dt_colVis.closest('.dt-uikit').find('.md-colVis .ColVis_ShowNone').on('click',function() {
                $(this).closest('.uk-dropdown').find('.data-md-icheck').prop('checked',false).iCheck('update')
            });

        }
    },
    dt_colsearch: function(){
        var $dt_colsearch = $('#dt_colsearch');
        var default_country = $('body').data('default');
        var selected = "selected";
        if($dt_colsearch.length){
            $dt_colsearch.DataTable( {
             initComplete: function () {
                this.api().columns().every( function (i,j) {
                    if(i == 3){
                        var column = this;
                        var select = $('<select class="filter uk-width-1-2" data-md-selectize data-placeholder="Select Countries..." ><option value=""></option></select>')
                            .prependTo( $('.dataTables_length')) 
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
         
                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );
         
                        column.data().unique().sort().each( function ( d, j ) {
                            var selecteds = (d == default_country)?'':'';
                            select.append( '<option value="'+d+'"'+selecteds+'>'+d+'</option>' )
                        });
                        var script = document.createElement("script");
                        script.type = "text/javascript";
                        script.src = baseURL + "assets/assets/js/altair_admin_common.min.js";
                        //script.innerHTML="$("
                        $(".dataTables_length").append(script);
                    }
                });
            }
            });
        }
    },
    dt_tableTools: function() {
        var $dt_tableTools = $('#dt_tableTools');
        if($dt_tableTools.length) {
            var table_tableTools = $dt_tableTools.DataTable();

            var tt = new $.fn.dataTable.TableTools( table_tableTools, {
                "sSwfPath": "bower_components/datatables-tabletools/swf/copy_csv_xls_pdf.swf"
            });

            $( tt.fnContainer() ).insertBefore( $dt_tableTools.closest('.dt-uikit').find('.dt-uikit-header'));

            $body.on('click',function(e) {
                if($body.hasClass('DTTT_Print')) {
                    if ( !$(e.target).closest(".DTTT").length && !$(e.target).closest(".uk-table").length) {
                        var esc = $.Event("keydown", { keyCode: 27 });
                        $body.trigger(esc);
                    }
                }
            })

        }
    }
};