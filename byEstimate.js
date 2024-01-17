function calculateModelProductionSchedule(
    model,
    quantity,
    startDateString,
    endDateString,
    baseStages
) {
    const startDate = new Date(startDateString);
    const endDate = new Date(endDateString);
    const modelStages = baseStages[model];

    if (!modelStages) {
        return null; // If the model is not found in base stages, return null
    }

    let currentStartDate = startDate;
    // current tambah 1 hari
    currentStartDate.setDate(currentStartDate.getDate() + 1);
    const stageDates = Object.keys(modelStages).reduce((acc, stage) => {
        const optimalTime = modelStages[stage]; // Shortest possible time for this stage
        const totalTime = optimalTime * quantity; // Scale time by quantity
        const stageEndDate = new Date(currentStartDate);
        stageEndDate.setDate(stageEndDate.getDate() + totalTime);

        // Ensure the stage end date does not exceed the overall end date
        if (stageEndDate > endDate) {
            stageEndDate.setTime(endDate.getTime());
        }

        acc[stage] = {
            tgl_produksi: currentStartDate.toISOString().split("T")[0], // tambah 1 hari
        };
        currentStartDate = new Date(stageEndDate); // Update start date for the next stage

        return acc;
    }, {});

    return {
        Model: model,
        Quantity: quantity,
        ProductionStages: stageDates,
        OverallStart: startDateString,
        OverallEnd: endDateString,
    };
}

// Example usage with optimized base stages
const baseStages = {
    "The Mini Fish 5.6": {
        Layer: 0.8,
        "Pole Frame": 0.9,
        "Press Body": 1.2,
        "Press full": 0.9,
        Finishing: 0.8,
    },
    "Little Fish 6'0 - rustic": {
        Layer: 0.8,
        "Pole Frame": 0.9,
        "Press Body": 1.2,
        "Press full": 0.9,
        Finishing: 0.8,
    },

    // ... other models
};

const model = "Little Fish 6'0 - rustic";
const quantity = 2;
const startDate = "2022-06-1"; // Example start date
const endDate = "2022-06-4"; // Example end date

const productionSchedule = calculateModelProductionSchedule(
    model,
    quantity,
    startDate,
    endDate,
    baseStages
);
console.log(productionSchedule);
