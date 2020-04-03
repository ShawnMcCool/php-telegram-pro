<?php namespace TelegramPro\Types;

/**
 * Three-letter ISO 4217 currency code, see more on currencies
 * https://core.telegram.org/bots/payments#supported-currencies
 */
final class Currency implements ApiReadType
{
    private static string $validCurrenciesJson = '{
  "AED": {
    "code": "AED",
    "title": "United Arab Emirates Dirham",
    "symbol": "AED",
    "native": "\u062f.\u0625.\u200f",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "367",
    "max_amount": "3672950"
  },
  "AFN": {
    "code": "AFN",
    "title": "Afghan Afghani",
    "symbol": "AFN",
    "native": "\u060b",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "7680",
    "max_amount": "76802101"
  },
  "ALL": {
    "code": "ALL",
    "title": "Albanian Lek",
    "symbol": "ALL",
    "native": "Lek",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": false,
    "exp": 2,
    "min_amount": "11445",
    "max_amount": "114450057"
  },
  "AMD": {
    "code": "AMD",
    "title": "Armenian Dram",
    "symbol": "AMD",
    "native": "\u0564\u0580.",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "49724",
    "max_amount": "497240222"
  },
  "ARS": {
    "code": "ARS",
    "title": "Argentine Peso",
    "symbol": "ARS",
    "native": "$",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "6423",
    "max_amount": "64231697"
  },
  "AUD": {
    "code": "AUD",
    "title": "Australian Dollar",
    "symbol": "AU$",
    "native": "$",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "165",
    "max_amount": "1650887"
  },
  "AZN": {
    "code": "AZN",
    "title": "Azerbaijani Manat",
    "symbol": "AZN",
    "native": "\u043c\u0430\u043d.",
    "thousands_sep": "\u00a0",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "169",
    "max_amount": "1695983"
  },
  "BAM": {
    "code": "BAM",
    "title": "Bosnia & Herzegovina Convertible Mark",
    "symbol": "BAM",
    "native": "KM",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "178",
    "max_amount": "1787722"
  },
  "BDT": {
    "code": "BDT",
    "title": "Bangladeshi Taka",
    "symbol": "BDT",
    "native": "\u09f3",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "8503",
    "max_amount": "85038640"
  },
  "BGN": {
    "code": "BGN",
    "title": "Bulgarian Lev",
    "symbol": "BGN",
    "native": "\u043b\u0432.",
    "thousands_sep": "\u00a0",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "177",
    "max_amount": "1778280"
  },
  "BND": {
    "code": "BND",
    "title": "Brunei Dollar",
    "symbol": "BND",
    "native": "$",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "143",
    "max_amount": "1439873"
  },
  "BOB": {
    "code": "BOB",
    "title": "Bolivian Boliviano",
    "symbol": "BOB",
    "native": "Bs",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "690",
    "max_amount": "6902247"
  },
  "BRL": {
    "code": "BRL",
    "title": "Brazilian Real",
    "symbol": "R$",
    "native": "R$",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "501",
    "max_amount": "5012395"
  },
  "CAD": {
    "code": "CAD",
    "title": "Canadian Dollar",
    "symbol": "CA$",
    "native": "$",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "140",
    "max_amount": "1406470"
  },
  "CHF": {
    "code": "CHF",
    "title": "Swiss Franc",
    "symbol": "CHF",
    "native": "CHF",
    "thousands_sep": "\'",
    "decimal_sep": ".",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "96",
    "max_amount": "964250"
  },
  "CLP": {
    "code": "CLP",
    "title": "Chilean Peso",
    "symbol": "CLP",
    "native": "$",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": true,
    "space_between": true,
    "exp": 0,
    "min_amount": "827",
    "max_amount": "8276021"
  },
  "CNY": {
    "code": "CNY",
    "title": "Chinese Renminbi Yuan",
    "symbol": "CN\u00a5",
    "native": "CN\u00a5",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "707",
    "max_amount": "7073901"
  },
  "COP": {
    "code": "COP",
    "title": "Colombian Peso",
    "symbol": "COP",
    "native": "$",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "405606",
    "max_amount": "4056060000"
  },
  "CRC": {
    "code": "CRC",
    "title": "Costa Rican Col\u00f3n",
    "symbol": "CRC",
    "native": "\u20a1",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "57802",
    "max_amount": "578025380"
  },
  "CZK": {
    "code": "CZK",
    "title": "Czech Koruna",
    "symbol": "CZK",
    "native": "K\u010d",
    "thousands_sep": "\u00a0",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "2470",
    "max_amount": "24700896"
  },
  "DKK": {
    "code": "DKK",
    "title": "Danish Krone",
    "symbol": "DKK",
    "native": "kr",
    "thousands_sep": "",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "676",
    "max_amount": "6767560"
  },
  "DOP": {
    "code": "DOP",
    "title": "Dominican Peso",
    "symbol": "DOP",
    "native": "$",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "5412",
    "max_amount": "54120243"
  },
  "DZD": {
    "code": "DZD",
    "title": "Algerian Dinar",
    "symbol": "DZD",
    "native": "\u062f.\u062c.\u200f",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "12360",
    "max_amount": "123605024"
  },
  "EGP": {
    "code": "EGP",
    "title": "Egyptian Pound",
    "symbol": "EGP",
    "native": "\u062c.\u0645.\u200f",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "1574",
    "max_amount": "15744896"
  },
  "EUR": {
    "code": "EUR",
    "title": "Euro",
    "symbol": "\u20ac",
    "native": "\u20ac",
    "thousands_sep": "\u00a0",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "90",
    "max_amount": "906850"
  },
  "GBP": {
    "code": "GBP",
    "title": "British Pound",
    "symbol": "\u00a3",
    "native": "\u00a3",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "82",
    "max_amount": "823801"
  },
  "GEL": {
    "code": "GEL",
    "title": "Georgian Lari",
    "symbol": "GEL",
    "native": "GEL",
    "thousands_sep": "\u00a0",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "342",
    "max_amount": "3429934"
  },
  "GTQ": {
    "code": "GTQ",
    "title": "Guatemalan Quetzal",
    "symbol": "GTQ",
    "native": "Q",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "793",
    "max_amount": "7932322"
  },
  "HKD": {
    "code": "HKD",
    "title": "Hong Kong Dollar",
    "symbol": "HK$",
    "native": "$",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "775",
    "max_amount": "7753295"
  },
  "HNL": {
    "code": "HNL",
    "title": "Honduran Lempira",
    "symbol": "HNL",
    "native": "L",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "2504",
    "max_amount": "25044996"
  },
  "HRK": {
    "code": "HRK",
    "title": "Croatian Kuna",
    "symbol": "HRK",
    "native": "kn",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "690",
    "max_amount": "6906014"
  },
  "HUF": {
    "code": "HUF",
    "title": "Hungarian Forint",
    "symbol": "HUF",
    "native": "Ft",
    "thousands_sep": "\u00a0",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "32238",
    "max_amount": "322382498"
  },
  "IDR": {
    "code": "IDR",
    "title": "Indonesian Rupiah",
    "symbol": "IDR",
    "native": "Rp",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "1600955",
    "max_amount": "16009550000"
  },
  "ILS": {
    "code": "ILS",
    "title": "Israeli New Sheqel",
    "symbol": "\u20aa",
    "native": "\u20aa",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "358",
    "max_amount": "3581380"
  },
  "INR": {
    "code": "INR",
    "title": "Indian Rupee",
    "symbol": "\u20b9",
    "native": "\u20b9",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "7481",
    "max_amount": "74819970"
  },
  "ISK": {
    "code": "ISK",
    "title": "Icelandic Kr\u00f3na",
    "symbol": "ISK",
    "native": "kr",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 0,
    "min_amount": "139",
    "max_amount": "1396402"
  },
  "JMD": {
    "code": "JMD",
    "title": "Jamaican Dollar",
    "symbol": "JMD",
    "native": "$",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "13562",
    "max_amount": "135624610"
  },
  "JPY": {
    "code": "JPY",
    "title": "Japanese Yen",
    "symbol": "\u00a5",
    "native": "\uffe5",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 0,
    "min_amount": "109",
    "max_amount": "1097235"
  },
  "KES": {
    "code": "KES",
    "title": "Kenyan Shilling",
    "symbol": "KES",
    "native": "Ksh",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "10510",
    "max_amount": "105109572"
  },
  "KGS": {
    "code": "KGS",
    "title": "Kyrgyzstani Som",
    "symbol": "KGS",
    "native": "KGS",
    "thousands_sep": "\u00a0",
    "decimal_sep": "-",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "8020",
    "max_amount": "80201495"
  },
  "KRW": {
    "code": "KRW",
    "title": "South Korean Won",
    "symbol": "\u20a9",
    "native": "\u20a9",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 0,
    "min_amount": "1217",
    "max_amount": "12171901"
  },
  "KZT": {
    "code": "KZT",
    "title": "Kazakhstani Tenge",
    "symbol": "KZT",
    "native": "\u20b8",
    "thousands_sep": "\u00a0",
    "decimal_sep": "-",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "44661",
    "max_amount": "446611698"
  },
  "LBP": {
    "code": "LBP",
    "title": "Lebanese Pound",
    "symbol": "LBP",
    "native": "\u0644.\u0644.\u200f",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "151399",
    "max_amount": "1513999818"
  },
  "LKR": {
    "code": "LKR",
    "title": "Sri Lankan Rupee",
    "symbol": "LKR",
    "native": "\u0dbb\u0dd4.",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "18738",
    "max_amount": "187380860"
  },
  "MAD": {
    "code": "MAD",
    "title": "Moroccan Dirham",
    "symbol": "MAD",
    "native": "\u062f.\u0645.\u200f",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "987",
    "max_amount": "9871502"
  },
  "MDL": {
    "code": "MDL",
    "title": "Moldovan Leu",
    "symbol": "MDL",
    "native": "MDL",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "1807",
    "max_amount": "18071495"
  },
  "MNT": {
    "code": "MNT",
    "title": "Mongolian T\u00f6gr\u00f6g",
    "symbol": "MNT",
    "native": "MNT",
    "thousands_sep": "\u00a0",
    "decimal_sep": ",",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "277590",
    "max_amount": "2775902882"
  },
  "MUR": {
    "code": "MUR",
    "title": "Mauritian Rupee",
    "symbol": "MUR",
    "native": "MUR",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "3935",
    "max_amount": "39354256"
  },
  "MVR": {
    "code": "MVR",
    "title": "Maldivian Rufiyaa",
    "symbol": "MVR",
    "native": "MVR",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "1541",
    "max_amount": "15410095"
  },
  "MXN": {
    "code": "MXN",
    "title": "Mexican Peso",
    "symbol": "MX$",
    "native": "$",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "2319",
    "max_amount": "23194850"
  },
  "MYR": {
    "code": "MYR",
    "title": "Malaysian Ringgit",
    "symbol": "MYR",
    "native": "RM",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "436",
    "max_amount": "4361250"
  },
  "MZN": {
    "code": "MZN",
    "title": "Mozambican Metical",
    "symbol": "MZN",
    "native": "MTn",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "6657",
    "max_amount": "66579914"
  },
  "NGN": {
    "code": "NGN",
    "title": "Nigerian Naira",
    "symbol": "NGN",
    "native": "\u20a6",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "36699",
    "max_amount": "366999861"
  },
  "NIO": {
    "code": "NIO",
    "title": "Nicaraguan C\u00f3rdoba",
    "symbol": "NIO",
    "native": "C$",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "3408",
    "max_amount": "34084664"
  },
  "NOK": {
    "code": "NOK",
    "title": "Norwegian Krone",
    "symbol": "NOK",
    "native": "kr",
    "thousands_sep": "\u00a0",
    "decimal_sep": ",",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "1045",
    "max_amount": "10454710"
  },
  "NPR": {
    "code": "NPR",
    "title": "Nepalese Rupee",
    "symbol": "NPR",
    "native": "\u0928\u0947\u0930\u0942",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "12065",
    "max_amount": "120652250"
  },
  "NZD": {
    "code": "NZD",
    "title": "New Zealand Dollar",
    "symbol": "NZ$",
    "native": "$",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "167",
    "max_amount": "1676970"
  },
  "PAB": {
    "code": "PAB",
    "title": "Panamanian Balboa",
    "symbol": "PAB",
    "native": "B\/.",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "100",
    "max_amount": "1001705"
  },
  "PEN": {
    "code": "PEN",
    "title": "Peruvian Nuevo Sol",
    "symbol": "PEN",
    "native": "S\/.",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "345",
    "max_amount": "3451499"
  },
  "PHP": {
    "code": "PHP",
    "title": "Philippine Peso",
    "symbol": "PHP",
    "native": "\u20b1",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "5061",
    "max_amount": "50610501"
  },
  "PKR": {
    "code": "PKR",
    "title": "Pakistani Rupee",
    "symbol": "PKR",
    "native": "\u20a8",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "16075",
    "max_amount": "160750183"
  },
  "PLN": {
    "code": "PLN",
    "title": "Polish Z\u0142oty",
    "symbol": "PLN",
    "native": "z\u0142",
    "thousands_sep": "\u00a0",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "412",
    "max_amount": "4125350"
  },
  "PYG": {
    "code": "PYG",
    "title": "Paraguayan Guaran\u00ed",
    "symbol": "PYG",
    "native": "\u20b2",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": true,
    "space_between": true,
    "exp": 0,
    "min_amount": "6593",
    "max_amount": "65930870"
  },
  "QAR": {
    "code": "QAR",
    "title": "Qatari Riyal",
    "symbol": "QAR",
    "native": "\u0631.\u0642.\u200f",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "364",
    "max_amount": "3641250"
  },
  "RON": {
    "code": "RON",
    "title": "Romanian Leu",
    "symbol": "RON",
    "native": "RON",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "438",
    "max_amount": "4384601"
  },
  "RSD": {
    "code": "RSD",
    "title": "Serbian Dinar",
    "symbol": "RSD",
    "native": "\u0434\u0438\u043d.",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "10654",
    "max_amount": "106549892"
  },
  "RUB": {
    "code": "RUB",
    "title": "Russian Ruble",
    "symbol": "RUB",
    "native": "\u0440\u0443\u0431.",
    "thousands_sep": "\u00a0",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "7748",
    "max_amount": "77480303"
  },
  "SAR": {
    "code": "SAR",
    "title": "Saudi Riyal",
    "symbol": "SAR",
    "native": "\u0631.\u0633.\u200f",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "375",
    "max_amount": "3755435"
  },
  "SEK": {
    "code": "SEK",
    "title": "Swedish Krona",
    "symbol": "SEK",
    "native": "kr",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "992",
    "max_amount": "9925320"
  },
  "SGD": {
    "code": "SGD",
    "title": "Singapore Dollar",
    "symbol": "SGD",
    "native": "$",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "143",
    "max_amount": "1431180"
  },
  "THB": {
    "code": "THB",
    "title": "Thai Baht",
    "symbol": "\u0e3f",
    "native": "\u0e3f",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "3259",
    "max_amount": "32590179"
  },
  "TJS": {
    "code": "TJS",
    "title": "Tajikistani Somoni",
    "symbol": "TJS",
    "native": "TJS",
    "thousands_sep": "\u00a0",
    "decimal_sep": ";",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "1022",
    "max_amount": "10223165"
  },
  "TRY": {
    "code": "TRY",
    "title": "Turkish Lira",
    "symbol": "TRY",
    "native": "TL",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "639",
    "max_amount": "6399635"
  },
  "TTD": {
    "code": "TTD",
    "title": "Trinidad and Tobago Dollar",
    "symbol": "TTD",
    "native": "$",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "676",
    "max_amount": "6768890"
  },
  "TWD": {
    "code": "TWD",
    "title": "New Taiwan Dollar",
    "symbol": "NT$",
    "native": "NT$",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "3020",
    "max_amount": "30204997"
  },
  "TZS": {
    "code": "TZS",
    "title": "Tanzanian Shilling",
    "symbol": "TZS",
    "native": "TSh",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "231410",
    "max_amount": "2314100930"
  },
  "UAH": {
    "code": "UAH",
    "title": "Ukrainian Hryvnia",
    "symbol": "UAH",
    "native": "\u20b4",
    "thousands_sep": "\u00a0",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": false,
    "exp": 2,
    "min_amount": "2827",
    "max_amount": "28270179"
  },
  "UGX": {
    "code": "UGX",
    "title": "Ugandan Shilling",
    "symbol": "UGX",
    "native": "USh",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 0,
    "min_amount": "3891",
    "max_amount": "38918518"
  },
  "USD": {
    "code": "USD",
    "title": "United States Dollar",
    "symbol": "$",
    "native": "$",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": false,
    "exp": 2,
    "min_amount": "100",
    "max_amount": 1000000
  },
  "UYU": {
    "code": "UYU",
    "title": "Uruguayan Peso",
    "symbol": "UYU",
    "native": "$",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "4486",
    "max_amount": "44864195"
  },
  "UZS": {
    "code": "UZS",
    "title": "Uzbekistani Som",
    "symbol": "UZS",
    "native": "UZS",
    "thousands_sep": "\u00a0",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 2,
    "min_amount": "951500",
    "max_amount": "9515000287"
  },
  "VND": {
    "code": "VND",
    "title": "Vietnamese \u0110\u1ed3ng",
    "symbol": "\u20ab",
    "native": "\u20ab",
    "thousands_sep": ".",
    "decimal_sep": ",",
    "symbol_left": false,
    "space_between": true,
    "exp": 0,
    "min_amount": "23245",
    "max_amount": "232455000"
  },
  "YER": {
    "code": "YER",
    "title": "Yemeni Rial",
    "symbol": "YER",
    "native": "\u0631.\u064a.\u200f",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "25034",
    "max_amount": "250349692"
  },
  "ZAR": {
    "code": "ZAR",
    "title": "South African Rand",
    "symbol": "ZAR",
    "native": "R",
    "thousands_sep": ",",
    "decimal_sep": ".",
    "symbol_left": true,
    "space_between": true,
    "exp": 2,
    "min_amount": "1731",
    "max_amount": "17311250"
  }
}';
    private string $code;

    private function __construct(string $code)
    {
        $this->code = $code;
    }

    public function toString(): string
    {
        return $this->code;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public static function fromApi($code): ?Currency
    {
        if ( ! static::codeIsValid($code)) {
            throw new CurrencyIsNotSupported($code);
        }

        return new static($code);
    }

    private static function codeIsValid(?string $code)
    {
        $codes = json_decode(static::$validCurrenciesJson, true);

        $found = array_filter(
            $codes, function ($codeRow) use ($code) {
            return $code == $codeRow['code'];
        });

        return count($found) > 0;
    }
}