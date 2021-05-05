import Chart from '../../../node_modules/chart.js/dist/Chart';
const defaultOptions = {
    legend: {
        position:        'bottom',
        labels: {
            boxWidth: 12
        },

    },
    tooltips: {
        mode:           'index',
        intersect:      false,
        position:       'nearest',
        caretSize :     0,
        bodySpacing :   10,
        titleFontSize:  16,
        bodyFontStyle:  18,
        displayLabel: false,
        //not showing labels in the tooltip
        callbacks: {
            label: function(tooltipItem, data) {
               return ' ' + tooltipItem.yLabel;
            }
        }
    },
    scales:{
        xAxes: [{
            gridLines: {
                display: false
            }
        }]
    }
};

const defaultCommonDatasets = {
    fill                : false,
    borderWidth         : 2 //width graphic's line
};

let colorDefault = [
    '#3c8dbc',
    '#00a65a',
    '#f39c12',
    '#d2d6de',
    '#f56954',
    '#00c0ef',
    '#001F3F',
    '#39CCCC',
    '#605ca8',
    '#ff851b',
    '#D81B60',
    '#111111'
];

/**
 * A class which draws graphics
 */
export class Graphic {
    /**
     * @param settings.el{string} - graphic's class.
     * @param settings.type{string} - type graphic.
     * @param settings.options{Object} - options for plugin.
     * @param settings.data{Object} - data for plugin.
     * @param settings.commonDatasets{Object} - common options to all line graph.
     * @param settings.descriptionBlk{string} - block's class with graph description .
     * @param settings.form{string} - class form.
     */
    constructor(settings) {
        this.el = settings.el;
        this.btnChangeType = settings.btnChangeType;
        this.type = settings.type;
        this.descriptionBlk = settings.descriptionBlk;
        this.form = settings.form;
        this.options = Object.assign({}, defaultOptions, settings.options);
        this.datasets = Object.assign({}, defaultCommonDatasets, settings.commonDatasets);


        this.data = {
            labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
                {
                    label               : 'label-item1',
                    data                : [65, 59, 80, 81, 56, 55, 40],
                },
                {
                    label               : 'label-item2',
                    data                : [28, 48, 40, 19, 86, 27, 90],
                }
            ]
		};
        this.token = $('#_token-csrf').html();
        this.chart;
    }

    /**
     * Initialize class.
     */
    init() {
        this.setData(()=> {
            this.updateColor();
            this.chart = this.initChart();

            this.initChangeView();
            this.initUpdateData();
            this.initUserDesc();
        });
    }

    /**
     * Initialize graphic.
     */
    initChart(){
        let _this = this;

        if($(this.el).length == 0) return;

        let chart = new Chart($(_this.el), {
            type: _this.type,
            options: _this.options,
            data:  _this.data
        });

        return chart;
    }
    setData(successFn){
         if($(this.el).data('url') == undefined ) {
            successFn()
            return;
        };

        this.sendRequest($(this.el).data('url'), null, $(this.el).data('method') ? $(this.el).data('method') : 'POST', successFn)
    }
    //Combine the datasets and specified datasets
    updateColor(){
        let mergeData = {};
        mergeData.datasets = this.data.datasets.map((el, i)=>{

            function getColor(i) {
                return colorDefault[i];
            }

            let colorLines = {
                borderColor: getColor(i),
                backgroundColor: getColor(i)
            };

            return Object.assign({}, colorLines, this.datasets, this.data.datasets[i]);
        });

        this.data = Object.assign({}, this.data, mergeData);
    }
    /**
     * Initialize event by click on the button to change type of graphic.
     */
    initChangeView(){
        let _this  = this;

        if($(this.btnChangeType).length == 0) return;

        $('body').on('click', this.btnChangeType, function(event){
            event.preventDefault();

            if($($(this).attr('data-graphic')) === null || $($(this).attr('data-graphic')) === undefined) return;

            switch(_this.type){
                case 'line':
                    _this.type = 'bar';
                    break;
                case 'bar':
                    _this.type = 'line';
                    break;
                default:
                    _this.type = 'line';
            }
             _this.chart.destroy();
            _this.chart = _this.initChart();
        })
    }

    /**
     * Updating data for graphics when changing fields of form.
     */
    initUpdateData(){
        let _this  = this;
        let $formFilter = $(this.form);

        if($formFilter === null || $formFilter === undefined) return;

        let thatField = $formFilter.find('input, select');

        thatField.on('change', function () {
            //field change check
            if($(this).attr('data-value') == $(this).val()){
                return;
            }

            $(this).attr('data-value', $(this).val());

            let thatForm = $(this).closest(_this.form);
            let url = thatForm.attr('action');
            let method = thatForm.attr('method') ? thatForm.attr('method') : 'POST';

            _this.sendRequest(url, thatForm, method, function () {
                _this.updateColor();

                _this.chart.destroy();
                _this.chart = _this.initChart();
            });
        })

    }
       /**
     * Chane a color of description block according to data
     */
    initUserDesc(){
        let $descriptionBlocks = $(this.descriptionBlk);
        if($descriptionBlocks === null || $descriptionBlocks === undefined) return;

        let _this = this;
        $descriptionBlocks.each(function(i) {
            $(this).css('border-color', _this.data.datasets[i].backgroundColor);
        });
    }

    /**
     * sends request to a back
     *
     * @param url - route to which will data pass
     * @param form - form which will be send
     * @param method - request method
     */
    sendRequest(url, form = null, method = 'POST', sucsessFn){
        let _this = this;
        let dataForRequest =  form  ? form.serialize() :  { _token: _this.token};

        $.ajax({
            type: method,
            data: dataForRequest,
            url : url,
            success: function(data) {
                let objData = JSON.parse(data);
                if(typeof objData == 'object'){
                    _this.data = Object.assign({}, _this.data, objData);
                }
                if(typeof sucsessFn == 'function'){
                    sucsessFn();
                }
            },
            error: function () {
                console.log('error');
                let errorData = {
                    labels  : ['January', 'February', 'March', 'April', 'May'],
                    datasets: [
                        {
                            label               : 'label-item1 ',
                            data                : [28, 48, 40, 19, 86],
                        },
                        {
                            backgroundColor     :'#f56954',
                            borderColor         :'#f56954', //color graphic's line
                            label               : 'label-item2',
                            data                : [28, 32, 40, 15, 68],
                        }
                    ]
                };

                _this.data = Object.assign({}, _this.data, errorData);

                if(typeof sucsessFn == 'function'){
                    sucsessFn();
                }
            }
        });
    };
}
