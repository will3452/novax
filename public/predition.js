// Function to calculate mean
function mean(arr) {
    return arr.reduce((acc, val) => acc + val, 0) / arr.length;
  }
  
  // Function to calculate slope (m) of the linear regression line
  function calculateSlope(x, y, xMean, yMean) {
    let numerator = 0;
    let denominator = 0;
    
    for (let i = 0; i < x.length; i++) {
      numerator += (x[i] - xMean) * (y[i] - yMean);
      denominator += Math.pow(x[i] - xMean, 2);
    }
    
    return numerator / denominator;
  }
  
  // Function to calculate intercept (b) of the linear regression line
  function calculateIntercept(xMean, yMean, slope) {
    return yMean - (slope * xMean);
  }
  
  // Function to predict future values using linear regression
  function predictFutureExpenses(x, y, futureX) {
    const xMean = mean(x);
    const yMean = mean(y);
    
    const slope = calculateSlope(x, y, xMean, yMean);
    const intercept = calculateIntercept(xMean, yMean, slope);
    
    return futureX.map((xValue) => (slope * xValue) + intercept);
  }
  
  // Given expense data for 5 days
  const expenses = [1000, 500, 4500, 7000, 2000];
  const timeIndices = [1, 2, 3, 4, 5]; // Days as time indices
  
  // Predicting expenses for future time indices (6th and 7th days)
  const futureTimeIndices = [6, 7];
  const predictedExpenses = predictFutureExpenses(timeIndices, expenses, futureTimeIndices);
  
  console.log('Predicted expenses for future time indices:', predictedExpenses);
  