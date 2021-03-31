var app = new Vue({
    el: '#schedule',
    data: {
        image: 'back_button.png'
    },
     methods:{
        home: function(){
            alert("click");
        }
    }
})

//calc date before render calendar so we can flip between months without resetting date
const date = new Date();

const renderCalendar = () => {
    const monthDays = document.querySelector(".days");
    const lastDay = new Date(date.getFullYear(), date.getMonth() + 1,0).getDate();
    const prevLastDay = new Date(date.getFullYear(), date.getMonth(),0).getDate();
    const firstDayIndex = date.getDay();
    const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1,0).getDay();
    const nextDays = 7 - lastDayIndex - 1;
    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];

    document.querySelector(".date h1").innerHTML = months[date.getMonth()];
    document.querySelector(".date p").innerHTML = new Date().toDateString();

    let days = "";

    // previous days from last month (POTENTIALLY REMOVE -1 in FOR LOOP)
    for(let x = firstDayIndex - 1; x > 0; x--) {
        days += `<div class="prev-date"> ${prevLastDay - x + 1}</div>`;
    }

    // days in the month
    for(let i = 1; i <= lastDay; i++) {
        if(i === new Date().getDate() && date.getMonth() === new Date().getMonth()) {
            days += `<div class="today">${i}</div>`;
        } else {
            days += `<div>${i}</div>`;
        }
    }

    // first couple days of next month
    for(let y = 1; y <= nextDays; y++) {
        days += `<div class="next-date">${y}</div>`;
        monthDays.innerHTML = days;
    }

};

// get arrows to move to other months (previous and next month)

document.querySelector(".prev").addEventListener("click", () => {
    date.setMonth(date.getMonth() - 1);
    renderCalendar();
});

document.querySelector(".next").addEventListener("click", () => {
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
});

document.querySelector(".days").addEventListener("click", () => {
    console.log("no events today");
    console.log(div.innerHTML);
});

renderCalendar();
