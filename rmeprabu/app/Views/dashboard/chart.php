<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pasien Hari Ini</h4>
                <div id="bar-chart" style="width:100%; height:400px;"></div>
            </div>
        </div>
    </div>

    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pasien Menurut Gender</h4>
                <div id="doughnut-chart" style="width:100%; height:400px;"></div>
            </div>
        </div>
    </div>

</div>
<!-- ============================================================== -->
<!-- End PAge Content -->

<script src="<?= base_url(); ?>/assets/plugins/echarts/echarts-all.js"></script>
<script type="text/javascript">
    let pasien = <?= $pasien; ?>;
    let pasien_gender = <?= $pasien_gender; ?>;
    // ============================================================== 
    // Bar chart option
    // ==============================================================
    var header_pasien = [];
    var data_pasien = [];
    for (i = 0; i < pasien.length; i++) {
        header_pasien.push(pasien[i]['name']);
        data_pasien.push({
            name: pasien[i].name,
            type: 'bar',
            data: [pasien[i].count],
            markPoint: {
                data: [{
                        type: 'max',
                        name: 'Max'
                    },
                    {
                        type: 'min',
                        name: 'Min'
                    }
                ]
            },
            markLine: {
                data: [{
                    type: 'average',
                    name: 'Average'
                }]
            }
        });
    }

    var myChart = echarts.init(document.getElementById('bar-chart'));

    // specify chart configuration item and data
    option = {
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: header_pasien
        },
        toolbox: {
            show: true,
            feature: {

                magicType: {
                    show: true,
                    type: ['line', 'bar']
                },
                restore: {
                    show: true
                },
                saveAsImage: {
                    show: true
                }
            }
        },
        color: ["#55ce63", "#009efb"],
        calculable: true,
        xAxis: [{
            type: 'category',
            data: ['Hari ini']
        }],
        yAxis: [{
            type: 'value'
        }],
        series: data_pasien
    };


    // use configuration item and data specified to show chart
    myChart.setOption(option, true), $(function() {
        function resize() {
            setTimeout(function() {
                myChart.resize()
            }, 100)
        }
        $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
    });


    // ============================================================== 
    // doughnut chart option
    // ============================================================== 
    var doughnutChart = echarts.init(document.getElementById('doughnut-chart'));

    // specify chart configuration item and data

    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            x: 'left',
            data: [pasien_gender[0]['name'], pasien_gender[1]['name']]
        },
        toolbox: {
            show: true,
            feature: {
                dataView: {
                    show: true,
                    readOnly: false
                },
                magicType: {
                    show: true,
                    type: ['pie', 'funnel'],
                    option: {
                        funnel: {
                            x: '25%',
                            width: '50%',
                            funnelAlign: 'center',
                            max: 1548
                        }
                    }
                },
                restore: {
                    show: true
                },
                saveAsImage: {
                    show: true
                }
            }
        },
        color: ["#f62d51", "#009efb"],
        calculable: true,
        series: [{
            name: 'Source',
            type: 'pie',
            radius: ['80%', '90%'],
            itemStyle: {
                normal: {
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                },
                emphasis: {
                    label: {
                        show: true,
                        position: 'center',
                        textStyle: {
                            fontSize: '30',
                            fontWeight: 'bold'
                        }
                    }
                }
            },
            data: [{
                    value: 335,
                    name: pasien_gender[0]['name']
                },
                {
                    value: 310,
                    name: pasien_gender[1]['name']
                },
            ]
        }]
    };



    // use configuration item and data specified to show chart
    doughnutChart.setOption(option, true), $(function() {
        function resize() {
            setTimeout(function() {
                doughnutChart.resize()
            }, 100)
        }
        $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
    });
</script>

<?= $this->endSection(); ?>