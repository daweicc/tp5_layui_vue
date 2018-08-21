/***** desc:接口文件;author:daweicc *****/
if (typeof jQuery === 'undefined') {

    document.write('Api.js must need Jquery plugin!!');
    exit;

}

var ApiHost = 'http://tp5.com/index.php/Admin/';

var API = {

    API_GET_GROUP_LIST: ApiHost + 'Group/index',        //获取组织架构

};

// window.apiUrl = apiUrl;