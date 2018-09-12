/***** desc:公共文件加载;author:daweicc *****/


/**
 * 设置域名
 * @type {string}
 */
// var SERVER_PATH = 'http://tp5.com/';
var SERVER_PATH = '/';

/**
 * 加载Vue文件
 */
/*document.write('<link href="' + SERVER_PATH + 'public/moduleVue/css/layui.css" rel="stylesheet" type="text/css" />');*/
document.write('<script src="' + SERVER_PATH + 'public/moduleVue/vue/vue.js" type="text/javascript" ></sc' + 'ript>');


/**
 * 加载jquery文件
 */
document.write('<script src="' + SERVER_PATH + 'public/Common/jquery.min.js" type="text/javascript"></sc' + 'ript>')

/**
 * 加载接口文件
 */
document.write('<script src="' + SERVER_PATH + 'public/Common/API.js?'+Math.random()+'" type="text/javascript" ></sc' + 'ript>');