'use strict';

var max_calories = Math.round(parseFloat(selected_max_of_column["max_calories"]) * 10) /10;
var max_protain  = Math.round(parseFloat(selected_max_of_column["max_protain"]) * 10) /10;
var max_fat      = Math.round(parseFloat(selected_max_of_column["max_fat"]) * 10) /10;
var max_carb     = Math.round(parseFloat(selected_max_of_column["max_carb"]) * 10) /10;


//SELECTの件数分ループ（結果のindex分）
//グラフ描画関数を呼び出す
for (let i = 0; i <= food_select_index; i++) {
    displayChart(i);
}



//引数としてselect結果のindexを受け取り、グラフを描画する
function displayChart(index) {

    // index.phpからjson形式の栄養成分の情報を受け取り元の形式（連想配列）に戻す
    var json_nutrition   = document.getElementById(index);
    
    // 受け取った食材のデータをjsオブジェクトに変換する
    var parsed_nutrition = JSON.parse(json_nutrition.dataset.pfc);

    // それぞれの栄養素の値を数値に変換し変数に代入
    //タンパク質g格納用変数
    var protain  = Math.round(parseFloat(parsed_nutrition["protain"]) * 10) /10;
    //脂質g格納用変数
    var fat      = Math.round(parseFloat(parsed_nutrition["fat"]) * 10) /10;
    //炭水化物格納用変数
    var carb     = Math.round(parseFloat(parsed_nutrition["carb"]) * 10) /10;
    //カロリkcalー格納用変数
    var calories = Math.round(parseFloat(parsed_nutrition["calories"]) * 10) /10;


    //////////////////////////////////////////////////////
    //カロリー用グラフ描画
    //////////////////////////////////////////////////////

    // グラフ描画の準備(描画位置はcanvasタグid属性myChart+index)
    var ctx_calories = document.getElementById("myChart_calories" + index).getContext('2d');

    var myChart = new Chart(ctx_calories, {
        type: 'horizontalBar',
        data: {
            labels: ["calories"],
            datasets: [{
                // それぞれの栄養素の値をグラフの値としてセット
                data: [calories],
                backgroundColor: [
                    'rgba(145,255,133,0.4)'
                ],
                borderColor: [
                    'rgba(36,255,20,1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            tooltips: {
                enabled: false
             },
            scales: {
                yAxes: [{
                    barPercentage: 0.7,
                    maxBarThickness: 20,
                    ticks: {
                        display: false,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    ticks: {
                        display: false,
                        min: 0,
                        max: max_calories
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });


    //////////////////////////////////////////////////////
    //タンパク質用グラフ描画
    //////////////////////////////////////////////////////

    // グラフ描画の準備(描画位置はcanvasタグid属性myChart+index)
    var ctx_protain = document.getElementById("myChart_protain" + index).getContext('2d');

    var myChart = new Chart(ctx_protain, {
        type: 'horizontalBar',
        data: {
            labels: ["protain"],
            datasets: [{
                // それぞれの栄養素の値をグラフの値としてセット
                data: [protain],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            tooltips: {
                enabled: false
             },
            scales: {
                yAxes: [{
                    barPercentage: 0.7,
                    maxBarThickness: 20,
                    ticks: {
                        display: false,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    ticks: {
                        display: false,
                        min: 0,
                        max: max_protain
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });


    //////////////////////////////////////////////////////
    //脂質用グラフ描画
    //////////////////////////////////////////////////////
    // グラフ描画の準備(描画位置はcanvasタグid属性myChart+index)
    var ctx_fat = document.getElementById("myChart_fat" + index).getContext('2d');

    //グラフ描画
    var myChart = new Chart(ctx_fat, {
        type: 'horizontalBar',
        data: {
            labels: ["fat"],
            datasets: [{
                // それぞれの栄養素の値をグラフの値としてセット
                data: [fat],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                tooltips: {
                    enabled: false
                 },
                yAxes: [{
                    barPercentage: 0.7,
                    maxBarThickness: 20,
                    ticks: {
                        display: false,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    ticks: {
                        display: false,
                        min: 0,
                        max: max_fat
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });


    //////////////////////////////////////////////////////
    //炭水化物用グラフ描画
    //////////////////////////////////////////////////////

    // グラフ描画の準備(描画位置はcanvasタグid属性myChart+index)
    var ctx_carb = document.getElementById("myChart_carb" + index).getContext('2d');

    //グラフ描画
    var myChart = new Chart(ctx_carb, {
        type: 'horizontalBar',
        data: {
            labels: ["carb"],
            datasets: [{
                // それぞれの栄養素の値をグラフの値としてセット
                data: [carb],
                backgroundColor: [
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            tooltips: {
                enabled: false
             },
            scales: {
                yAxes: [{
                    barPercentage: 0.7,
                    maxBarThickness: 20,
                    ticks: {
                        display: false,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    ticks: {
                        display: false,
                        min: 0,
                        max: max_carb
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });



}


