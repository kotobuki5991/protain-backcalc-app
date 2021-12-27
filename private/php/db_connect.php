<?php
require_once(__DIR__ . '/token.php');
session_start();
class db_connect {

    public $results = null;
    public $max_of_column = null;

    public function __construct()
    {
         // トークンをセット
        token::create();   
    }

    public function exec_sql (){

        try {
            $hostname=getenv('DB_HOSTNAME');
            $dbname=getenv('DB_NAME');
            $password=getenv('DB_PASSWORD');
            $port=getenv('DB_PORT');
            $user=getenv('DB_USERNAME');
            

            // heroku本番環境用
            $dsn = "mysql:host={$hostname}:{$port};dbname={$dbname};charset=utf8mb4";
            $pdo = new PDO($dsn, $user, $password);
            
            
            
            // もしpost送信かつ入力が空文字出ない場合
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['protain-amount'] != '') {
                
                // トークンのバリデーション関数呼び出し
                token::validate();
                // 検索フォームに入力された値を変数に代入
                $input_grams = $_POST['protain-amount'];
                // セレクトボックスで選択された値を変数に代入
                $sort_element = $_POST['sort'];
                
                // 入力されたg数のタンパク質を摂る為に必要な量を計算し、全件検索
                // 栄養素情報取得sql
                $sql = 'SELECT name
                    , pass_of_image
                    , (calculated_fn.protain * magnification) as protain
                    , (calculated_fn.fat * magnification) as fat
                    , (calculated_fn.carb * magnification) as carb
                    , (calculated_fn.calories * magnification) as calories
                    , (calculated_fn.magnification * 100) as required_amount
                    FROM 
                        (   SELECT name
                            , pass_of_image
                            , protain
                            , fat
                            , carb
                            , (protain * 4) + (fat * 9) + (carb * 4) as calories
                            -- 必要タンパク質摂取に必要な倍率を計算
                            , (:input_grams / protain) as magnification
                            FROM food_nutrition
                        ) as calculated_fn
                    ORDER BY '.$sort_element;

                $stmt = $pdo->prepare($sql);
                // プレースホルダ:input_gramsと:sort_elementに、フォームに入力された値をバインドする
                $stmt->bindValue(':input_grams', $input_grams);
                $stmt->execute();
                $this->results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                //各項目最大値取得用sql
                $sql = "SELECT  max(calculated_fn_for_get_max.calories) as max_calories
                    , max(calculated_fn_for_get_max.protain) as max_protain
                    , max(calculated_fn_for_get_max.fat) as max_fat
                    , max(calculated_fn_for_get_max.carb) as max_carb
                    FROM
                        ( SELECT name
                        , pass_of_image
                        , (calculated_fn.protain * magnification) as protain
                        , (calculated_fn.fat * magnification) as fat
                        , (calculated_fn.carb * magnification) as carb
                        , (calculated_fn.calories * magnification) as calories
                        , (calculated_fn.magnification * 100) as required_amount
                        FROM 
                            (   SELECT name
                                , pass_of_image
                                , protain
                                , fat
                                , carb
                                , (protain * 4) + (fat * 9) + (carb * 4) as calories
                                -- 必要タンパク質摂取に必要な倍率を計算
                                , (:input_grams / protain) as magnification
                                FROM food_nutrition
                            ) as calculated_fn
                        ) as calculated_fn_for_get_max";
        
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':input_grams', $input_grams);
                $stmt->execute();
                $this->max_of_column = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            // そうでない場合（post送信でないまたは入力が空文字の場合）
            else {

                // POST送信かつ選択されたものがカロリー順でない場合は、セレクトボックスで選択された値を
                // そうでない場合カロリーの計算式を文字列で変数に代入
                $sort_element = isset($_POST['sort']) && $_POST['sort'] != 'calories' ? $_POST['sort'] : '(protain * 4) + (fat * 9) + (carb * 4)';

                // デフォルトの全件取得
                // 栄養素情報取得sql
                $sql = 'SELECT name
                    , pass_of_image
                    , protain
                    , fat
                    , carb
                    , (protain * 4) + (fat * 9) + (carb * 4) as calories
                    , 100 as required_amount
                    FROM food_nutrition
                    ORDER BY '.$sort_element;

                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $this->results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                //各項目最大値取得用sql
                $sql = 'SELECT  max((protain * 4) + (fat * 9) + (carb * 4)) as max_calories
                    , max(protain) as max_protain
                    , max(fat) as max_fat
                    , max(carb) as max_carb
                    FROM food_nutrition';
        
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $this->max_of_column = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

    }


}