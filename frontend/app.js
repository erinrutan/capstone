var app = new Vue({
    el: '#app', // corresponds with div id in html file
    data: {
        image: '../frontend/row.jpeg'
    },
    methods: {
        goToSchedule: function () {
            `
            <a href="../frontend/schedule.html">Schedule</a>
            `
            
        }
    }
})