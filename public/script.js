let labels4 = ['Articles', 'Events', 'Suivi', 'Msg', 'Technical', 'Posts'];
let data4 = [83, 67, 66, 61, 47, 87];
let colors4 = ['#49A9EA', '#36CAAB', '#34495E', '#B370CF', '#AC5353', '#CFD4D8'];

let myChart4 = document.getElementById("myChart4").getContext('2d');

let chart4 = new Chart(myChart4, {
    type: 'pie',
    data: {
        labels: labels4,
        datasets: [ {
            data: data4,
            backgroundColor: colors4
        }]
    },
    options: {
        title: {
            text: "Reclamations by Categories",
            display: true
        }
    }
});