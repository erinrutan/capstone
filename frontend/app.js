// import { Amplify } from 'aws-amplify';
// import config from './config';


var app = new Vue({
    el: '#app', // corresponds with div id in html file
    data: {
        image: 'row2.jpeg'
    },
    methods: {
        goToSchedule: function () {
            `
            <a href="schedule.html">Schedule</a>
            `
            
        }
    }
})