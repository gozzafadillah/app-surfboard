function parseDate(dateString) {
    // Check if the dateString is empty and return null if so
    if (!dateString.trim()) return null;

    // Assuming the dateString is in "d MMMM yyyy" format, e.g., "2 Juni 2022"
    const [day, monthName, year] = dateString.split(" ");

    // Map month names to month numbers
    const monthNames = {
        Januari: "01",
        Februari: "02",
        Maret: "03",
        April: "04",
        Mei: "05",
        Juni: "06",
        Juli: "07",
        Agustus: "08",
        September: "09",
        Oktober: "10",
        November: "11",
        Desember: "12",
    };

    // Pad the day with a zero if necessary
    const dayPadded = day.padStart(2, "0");
    const month = monthNames[monthName];

    // Return the dateString in "yyyy-MM-dd" format
    return `${year}-${month}-${dayPadded}`;
}

function calculateShortestProcessTime(data) {
    // let shortestTime = Infinity;
    // let shortestProcess = null;

    const withProcessTimes = data.map((item) => {
        const start = parseDate(item["Pole Frame"]);
        const end = parseDate(item.Finishing);

        // If either date is null, set process time as Infinity
        const startDate = start ? new Date(start) : new Date();
        const endDate = end ? new Date(end) : new Date();
        const processTime = (endDate - startDate) / (1000 * 60 * 60 * 24); // Convert milliseconds to days
        // Calculate the weighted process time based on quantity
        const weightedProcessTime = processTime * (item.Quantity || 1); // Default to 1 if Quantity is not provided

        return {
            ...item,
            ProcessTime: processTime,
            WeightedProcessTime: weightedProcessTime,
        };
    });

    // Sort the array by weighted process time from shortest to longest
    withProcessTimes.sort(
        (a, b) => a.WeightedProcessTime - b.WeightedProcessTime
    );

    return withProcessTimes;
}
const data = [
    {
        Model: "The Brunette 7'4\"",
        Size: "",
        Layer: "",
        "Pole Frame": "2 Juni 2022",
        "Press Body": "3 Juni 2022",
        "Press full": "4 Juni 2022",
        Finishing: "4 Juni 2022",
        Quantity: 5,
    },
    {
        Model: "The Mini Fish 5.6",
        Size: "",
        Layer: "",
        "Pole Frame": "2 Juni 2022",
        "Press Body": "3 Juni 2022",
        "Press full": "4 Juni 2022",
        Finishing: "6 Juni 2022",
        Quantity: 8,
    },
    {
        Model: "Little Fish 6'0 - rustic",
        Size: "",
        Layer: "",
        "Pole Frame": "2 Juni 2022",
        "Press Body": "3 Juni 2022",
        "Press full": "4 Juni 2022",
        Finishing: "6 Juni 2022",
        Quantity: 3,
    },
    {
        Model: "The Mini Fish 5.6",
        Size: "",
        Layer: "",
        "Pole Frame": "2 Juni 2022",
        "Press Body": "3 Juni 2022",
        "Press full": "6 Juni 2022",
        Finishing: "7 Juni 2022",
        Quantity: 2,
    },
    {
        Model: "Bon Voyage 8'3.6\"",
        Size: "",
        Layer: "",
        "Pole Frame": "3 Juni 2022",
        "Press Body": "4 Juni 2022",
        "Press full": "6 Juni 2022",
        Finishing: "7 Juni 2022",
        Quantity: 10,
    },
    {
        Model: "Woody",
        Size: "",
        Layer: "",
        "Pole Frame": "3 Juni 2022",
        "Press Body": "6 Juni 2022",
        "Press full": "7 Juni 2022",
        Finishing: "8 Juni 2022",
        Quantity: 2,
    },
    {
        Model: "Longboard 9'64\" / Balsa 9'6\"",
        Size: "",
        Layer: "",
        "Pole Frame": "3 Juni 2022",
        "Press Body": "6 Juni 2022",
        "Press full": "8 Juni 2022",
        Finishing: "8 Juni 2022",
        Quantity: 11,
    },
    {
        Model: "Woody",
        Size: "",
        Layer: "",
        "Pole Frame": "3 Juni 2022",
        "Press Body": "6 Juni 2022",
        "Press full": "7 Juni 2022",
        Finishing: "8 Juni 2022",
        Quantity: 12,
    },
    {
        Model: "Vanuna",
        Size: "",
        Layer: "",
        "Pole Frame": "4 Juni 2022",
        "Press Body": "6 Juni 2022",
        "Press full": "7 Juni 2022",
        Finishing: "8 Juni 2022",
        Quantity: 5,
    },
    {
        Model: "Bon Voyage 8'3.6\"",
        Size: "",
        Layer: "",
        "Pole Frame": "4 Juni 2022",
        "Press Body": "6 Juni 2022",
        "Press full": "7 Juni 2022",
        Finishing: "7 Juni 2022",
        Quantity: 3,
    },
    {
        Model: "Mono Mono",
        Size: "",
        Layer: "",
        "Pole Frame": "6 Juni 2022",
        "Press Body": "7 Juni 2022",
        "Press full": "8 Juni 2022",
        Finishing: "8 Juni 2022",
        Quantity: 1,
    },
    {
        Model: "Little Fish 6'0 - rustic",
        Size: "",
        Layer: "",
        "Pole Frame": "6 Juni 2022",
        "Press Body": "7 Juni 2022",
        "Press full": "8 Juni 2022",
        Finishing: "9 Juni 2022",
        Quantity: 2,
    },
    {
        Model: "Longboard 9'64\" / Balsa 9'6\"",
        Size: "",
        Layer: "",
        "Pole Frame": "6 Juni 2022",
        "Press Body": "7 Juni 2022",
        "Press full": "8 Juni 2022",
        Finishing: "8 Juni 2022",
        Quantity: 1,
    },
    {
        Model: "Little Fish 6'0 - rustic",
        Size: "",
        Layer: "",
        "Pole Frame": "7 Juni 2022",
        "Press Body": "8 Juni 2022",
        "Press full": "9 Juni 2022",
        Finishing: "10 Juni 2022",
        Quantity: 1,
    },
    {
        Model: "Longboard 9'64\" / Balsa 9'6\"",
        Size: "",
        Layer: "",
        "Pole Frame": "6 Juni 2022",
        "Press Body": "7 Juni 2022",
        "Press full": "8 Juni 2022",
        Finishing: "8 Juni 2022",
        Quantity: 11,
    },
];
// Calculate the process schedule with quantities taken into account
const processedData = calculateShortestProcessTime(data);

// Convert to JSON
const jsonData = JSON.stringify(processedData, null, 2);
console.log(jsonData);
