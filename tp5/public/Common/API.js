/***** desc:文件注释;author:daweicc *****/
if (typeof jQuery === 'undefined') {

    throw new Error('Api.js must need Jquery plugin!!')

}

var ApiHost = 'http://tp5.com/index.php/';

var API = {

    API_GET_GROUP_LIST: ApiHost + 'Group/index',        //获取组织架构

};

// window.apiUrl = apiUrl;