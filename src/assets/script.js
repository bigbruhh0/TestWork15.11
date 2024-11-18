document.addEventListener("DOMContentLoaded", () => {
    const regionSelect = document.getElementById("region-select");
    const courierSelect = document.getElementById("courier-select");
    const departureDateInput = document.getElementById("departure-date");
    const addTripForm = document.getElementById("add-trip-form");
    const responseDiv = document.getElementById("response");

    const tripsTable = document.getElementById("trips-table");
    const filterDepartureInput = document.getElementById("filter-departure-date");
    const filterArrivalInput = document.getElementById("filter-arrival-date");
    const filterBtn = document.getElementById("filter-btn");

    function loadRegions() {
        fetch("/api/regions.php")
            .then((res) => res.json())
            .then((data) => {
                regionSelect.innerHTML = "";
                data.forEach((region) => {
                    const option = document.createElement("option");
                    option.value = region.id;
                    option.textContent = region.name;
                    regionSelect.appendChild(option);
                });
            })
            .catch((error) => {
                console.error("Ошибка загрузки регионов:", error);
            });
    }

    function loadCouriers() {
        fetch("/api/couriers.php")
            .then((res) => res.json())
            .then((data) => {
                courierSelect.innerHTML = "";
                data.forEach((courier) => {
                    const option = document.createElement("option");
                    option.value = courier.id;
                    option.textContent = courier.name;
                    courierSelect.appendChild(option);
                });
            })
            .catch((error) => {
                console.error("Ошибка загрузки курьеров:", error);
            });
    }

    function addTrip(event) {
        event.preventDefault();

        const data = {
            region_id: regionSelect.value,
            courier_id: courierSelect.value,
            departure_date: departureDateInput.value,
        };

        fetch("/api/add_trip.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data),
        })
            .then((res) => res.json())
            .then((response) => {
                console.log("Ответ от сервера:", response);
                if (response.success) {
                    responseDiv.textContent = "Поездка успешно добавлена! Дата прибытия: "+response.arrival_date;
                    responseDiv.style.color = "green";
                    //addTripForm.reset();
                } else {
                    responseDiv.textContent = "Ошибка: " + response.error;
                    responseDiv.style.color = "red";
                }
            })
            .catch((error) => {
                console.error(error);
                responseDiv.textContent = error;
                responseDiv.style.color = "red";
                if (response.available_from) {
                        responseDiv.textContent+= " Курьер доступен с "+response.available_from;
                    }
                if (response.conflict_date) {
                        responseDiv.textContent+= " Дата пересечения: "+response.conflict_date;
                    }
            });
    }

    function loadTrips(departureDate = null, arrivalDate = null) {
    let url = "/api/trips.php";

    const params = new URLSearchParams();
    if (departureDate) {
        params.append("departure_date", departureDate);
    }
    if (arrivalDate) {
        params.append("arrival_date", arrivalDate);
    }

    if (params.toString()) {
        url += `?${params.toString()}`;
    }

    fetch(url)
        .then((res) => res.json())
        .then((data) => {
            const tripsTable = document.getElementById("trips-table");
            tripsTable.innerHTML = "";

            data.forEach((trip) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${trip.id}</td>
                    <td>${trip.region}</td>
                    <td>${trip.courier}</td>
                    <td>${trip.departure_date}</td>
                    <td>${trip.arrival_date}</td>
                `;
                tripsTable.appendChild(row);
            });
        })
        .catch((error) => {
            console.error("Ошибка загрузки расписания:", error);
        });
    }


    function filterTrips() {
        const departureDate = filterDepartureInput.value;
        const arrivalDate = filterArrivalInput.value;
        loadTrips(departureDate,arrivalDate);
    }

    if (addTripForm) {
        addTripForm.addEventListener("submit", addTrip);
    }
    if (filterBtn) {
        filterBtn.addEventListener("click", filterTrips);
    }

    if (regionSelect && courierSelect) {
        loadRegions();
        loadCouriers();
        console.log('Перезагружены рег кур')
    }
    if (tripsTable) {
        loadTrips();
    }
});
