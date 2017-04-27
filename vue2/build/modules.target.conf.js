var path = require('path')

var modules = {
    "home": {
        index: '../../frontend/web/dist/index.html',
        assetsRoot: '../../frontend/web/dist',
        assetsSubDirectory: 'static',
        assetsPublicPath: '../../',
    },
    "admin":{
        index: '../../backend/web/dist/index.html',
        assetsRoot: '../../backend/web/dist',
        assetsSubDirectory: 'static',
        assetsPublicPath: '../../',
    }
};
module.exports = {

    getModuleTarget: function (moduleName) {
        return {
            index: path.resolve(__dirname, modules[moduleName].index),
            assetsRoot: path.resolve(__dirname, modules[moduleName].assetsRoot),
            assetsSubDirectory: modules[moduleName].assetsSubDirectory,
            assetsPublicPath: modules[moduleName].assetsPublicPath,
        }
    }
}