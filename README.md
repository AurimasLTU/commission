## Commission calculator api for completed transactions

To calculate use post request on api route /commission/calculate. "Commission" property in modified input represents 
calculated commission.

Example input: 

[ 
		{"bin":"45717360","amount":"100.00","currency":"EUR"},
		{"bin":"516793","amount":"50.00","currency":"USD"},
		{"bin":"45417360","amount":"10000.00","currency":"JPY"},
		{"bin":"41417360","amount":"130.00","currency":"USD"},
		{"bin":"4745030","amount":"2000.00","currency":"GBP"}
]

Example Output:

[
        {"bin":"45717360","amount":"100.00","currency":"EUR","commission":1},
        {"bin":"516793","amount":"50.00","currency":"USD","commission":0.45},
        {"bin":"45417360","amount":"10000.00","currency":"JPY","commission":1.64},
        {"bin":"41417360","amount":"130.00","currency":"USD","commission":2.31},
        {"bin":"4745030","amount":"2000.00","currency":"GBP","commission":44.89}
]
