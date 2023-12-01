export default {
    methods: {
        mean(arr) {
            return arr.reduce((acc, val) => acc + val, 0) / arr.length;
        }, 
        calculateSlope(x, y, xMean, yMean) {
            let numerator = 0;
            let denominator = 0;
            
            for (let i = 0; i < x.length; i++) {
              numerator += (x[i] - xMean) * (y[i] - yMean);
              denominator += Math.pow(x[i] - xMean, 2);
            }
            
            return numerator / denominator;
        }, 
        calculateIntercept(xMean, yMean, slope) {
            return yMean - (slope * xMean);
        }, 
        predictFutureExpenses(x, y, futureX) {
            const xMean = this.mean(x);
            const yMean = this.mean(y);
            
            const slope = this.calculateSlope(x, y, xMean, yMean);
            const intercept = this.calculateIntercept(xMean, yMean, slope);
            
            return futureX.map((xValue) => (slope * xValue) + intercept);
          }, 
    },
    filters: {
        format(amount) {
            const currencyFormatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'PHP' // Change this to the currency you want
              });

              return currencyFormatter.format(amount);
          }, 
    }
}