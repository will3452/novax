export const moneyFormat = (amount) => {
    let currency = 'PHP'
    let formatter = new Intl.NumberFormat('en-Us', {style: 'currency', currency })
    return formatter.format(amount)
}

export const deepCopy = (value)  => {
    return JSON.parse(JSON.stringify(value))
}
