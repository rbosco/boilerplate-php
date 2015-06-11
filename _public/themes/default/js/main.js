/*global require*/
'use strict';

require.config({
    baseUrl:'_public/themes/default/bower_components/',
    shim: {
        underscore: {exports: '_'},
        backbone: {deps: ['underscore','jquery'],exports: 'Backbone'},
        bootstrap: {deps: ['jquery'],exports: 'jquery'}
    },
    paths: {
        jquery: 'jquery/dist/jquery',
        backbone: 'backbone/backbone.min',
        underscore: 'underscore/underscore.min',
        bootstrap: 'bootstrap/dist/js/bootstrap'
    }
});

define(["jquery","bootstrap"],function($){
   console.log('O require está funcionando'); 
   console.log('O collapse está funcionando'); 
});
