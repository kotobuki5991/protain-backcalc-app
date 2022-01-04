#逆タン！！-タンパク質量から食材の量を逆算-
(https://protain-backcalc-app.herokuapp.com/)

##概要
摂取したいタンパク質の量から、必要な食材と量を検索できるアプリです。

##　使用技術
Docker(環境構築)
PHP7.4.22
mysql5.7
JavaScript
HTML
CSS
heroku

##開発の目的
既存サービスの　カロリーSlism(https://calorie.slism.jp/calorie/)を使用する中で
不便に感じた部分を改善し、自身で活用したかったため。

###・不便に感じた点
「食材の名前とg数で検索」→「栄養素の表示」は可能だが、
その逆である「摂取したい栄養素（g）で検索」→「必要な食材の量（g）の表示」ができない点。

例・・・タンパク質を30g摂取するにはどの食材を何g食べれば良いか？などの検索

筋力トレーニングや減量をする人は、摂取したいタンパク質量（g）が決まっています。
例に挙げたような検索ができなければ、検索に時間がかかり不便です。

##機能
・検索機能
「摂取したいタンパク質（g）で検索」→「必要な食材の量（g）の表示」
・並び替え
低カロリー順、低脂質順、低炭水化物順、高タンパク順

