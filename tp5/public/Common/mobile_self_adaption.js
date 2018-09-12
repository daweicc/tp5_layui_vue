/***** desc:手机端自适应;author:xiaoting *****/
(function () {
    var designW = 750;   // 设计稿宽度
    var font_rate = 100;

    document.getElementsByTagName("html")[0].style.fontSize = document.body.offsetWidth / designW * font_rate + "px";
    document.getElementsByTagName("body")[0].style.fontSize = document.body.offsetWidth / designW * font_rate + "px";

    window.addEventListener("resize", function () {
        document.getElementsByTagName("html")[0].style.fontSize = document.body.offsetWidth / designW * font_rate +
            "px";
        document.getElementsByTagName("body")[0].style.fontSize = document.body.offsetWidth / designW * font_rate +
            "px";
    }, false);
})();