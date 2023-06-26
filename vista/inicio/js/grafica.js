const $grafica = document.querySelector("#myChart");

const etiquetas = ["Receptiva", "Expresiva", "Escritura", "Personal", "Domestico", "Comunitario", "Relaciones Interpersonales", "Juego Y Tiempo Libre", "Habilidades de Afrontamiento", "Gruesa", "Fina"]

const datosdominios = {
    label: "Vscore por medio de raw score",
    data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
    backgroundColor: 'rgba(54,162,235,0.2)',
    borderColor: 'rgba(54,162,235,1)',
    borderWidth: 1,

};
new Chart($grafica, {
    type: "line",
    data: {
        labels: etiquetas,
        datasets: [
            datosdominios
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: 0
                }
            }],
        },
    }
});

$grafica.clientWidth("400")

