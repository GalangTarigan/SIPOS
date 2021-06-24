/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');


window._ = require('lodash');

// import Echo from 'laravel-echo'
import Echo from "laravel-echo"
import Pusher from "pusher-js"
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '6077dc6bf577423fd4f1',
    cluster: 'ap1',
    forceTLS: true,
  });
  



