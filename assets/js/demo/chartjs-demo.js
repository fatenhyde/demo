$(function () {

    var barData = {
        labels: ["Perlis", "Kedah", "P.Pinang", "Perak", "Selangor", "K. Lumpur", "N. Sembilan", "Melaka",
            "Johor", "Pahang", "Kelantan", "Terengganu", "Sabah", "Sarawak"],
        datasets: [
            {
                label: "Premis Belum Kemaskini",
                backgroundColor: '#ed5565',
                pointBorderColor: "#fff",
                data: [65, 59, 80, 81, 56, 55, 80, 65, 59, 80, 81, 56, 55, 55]
            }
        ]
    };


    var barData2 = {
        labels: ["Perlis", "Kedah", "P.Pinang", "Perak", "Selangor", "K. Lumpur", "N. Sembilan", "Melaka",
            "Johor", "Pahang", "Kelantan", "Terengganu", "Sabah", "Sarawak"],
        datasets: [
            {
                backgroundColor: ['#ed5565', '#ed5565', '#ed5565', "blue", '#ed5565', '#ed5565',
                    '#ed5565', "blue", '#ed5565', '#ed5565', "#ed5565", "blue", '#ed5565', "blue"],
                pointBorderColor: "#fff",
                data: [65, 59, 80, -81, 56, 55, 80, -65, 59, 80, 81, -56, 55, -55]
            }
        ]
    };

    var barOptions = {
        responsive: true
    };

    var barOptions2 = {
        responsive: true,
        legend: {
            display: false
        },
        tooltips: {
            enabled: false
        }
    };





    var ctx1 = document.getElementById("barChart").getContext("2d");
    var chart = new Chart(ctx1, { type: 'horizontalBar', data: barData, options: barOptions });

    var ctx2 = document.getElementById("barChart2").getContext("2d");
    new Chart(ctx2, { type: 'bar', data: barData2, options: barOptions2 });


    var words = [
        { text: "Bawang putih", weight: 20 },
        { text: "Ayam", weight: 10.5 },
        { text: "Ikan", weight: 9.4 },
        { text: "Telur", weight: 8 },
        { text: "Ais krim", weight: 6.2 },
        { text: "Sos Cili", weight: 5 },
        { text: "Tomato", weight: 5 },
        { text: "Bawang Merah", weight: 13 },
        { text: "Daging kambing", weight: 10.5 },
        { text: "Ikan Keli", weight: 9.4 },
        { text: "Telur Masin", weight: 8 },
        { text: "Air Mineral", weight: 6.2 },
        { text: "Kicap", weight: 5 },
        { text: "Cili Padi", weight: 5 },
    ];

    $(document).ready(function () {
        $('#demo').jQCloud(words, {
            autoResize: true
        });

        $('.slick_demo_3').slick({
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            adaptiveHeight: true,
            autoplay: true,
            autoplaySpeed: 2000
        });
    })


});