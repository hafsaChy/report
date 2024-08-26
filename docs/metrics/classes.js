var classes = [
    {
        "name": "App\\AdventureGame\\Game",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "currentRoomName",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "currentRoomItems",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setCurrentRoom",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "visitedRooms",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getDirectionsDescription",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getAvailableDirections",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "roomAccordingToDirection",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "checkIngredients",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "inspectRoomOrItem",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "pickUpItem",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "putBack",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "basketItem",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "checkItemInBasket",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 14,
        "nbMethods": 11,
        "nbMethodsPrivate": 1,
        "nbMethodsPublic": 10,
        "nbMethodsGetter": 3,
        "nbMethodsSetters": 0,
        "wmc": 45,
        "ccn": 35,
        "ccnMethodMax": 9,
        "externals": [
            "App\\Entity\\Room",
            "App\\Entity\\Room",
            "App\\Entity\\Item",
            "App\\Entity\\Item"
        ],
        "parents": [],
        "implements": [],
        "lcom": 1,
        "length": 337,
        "vocabulary": 72,
        "volume": 2079.26,
        "difficulty": 19.57,
        "effort": 40682.01,
        "level": 0.05,
        "bugs": 0.69,
        "time": 2260,
        "intelligentContent": 106.27,
        "number_operators": 120,
        "number_operands": 217,
        "number_operators_unique": 11,
        "number_operands_unique": 61,
        "cloc": 77,
        "loc": 262,
        "lloc": 185,
        "mi": 59.83,
        "mIwoC": 22.6,
        "commentWeight": 37.23,
        "kanDefect": 3.22,
        "relativeStructuralComplexity": 121,
        "relativeDataComplexity": 1.72,
        "relativeSystemComplexity": 122.72,
        "totalStructuralComplexity": 1694,
        "totalDataComplexity": 24.08,
        "totalSystemComplexity": 1718.08,
        "package": "App\\AdventureGame\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 2,
        "instability": 1,
        "numberOfUnitTests": 3,
        "violations": {}
    },
    {
        "name": "App\\AdventureGame\\Availables",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "availableActions",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "availableOptions",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 2,
        "nbMethods": 2,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 2,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 2,
        "ccn": 1,
        "ccnMethodMax": 1,
        "externals": [],
        "parents": [],
        "implements": [],
        "lcom": 2,
        "length": 43,
        "vocabulary": 38,
        "volume": 225.66,
        "difficulty": 1.08,
        "effort": 244.47,
        "level": 0.92,
        "bugs": 0.08,
        "time": 14,
        "intelligentContent": 208.3,
        "number_operators": 4,
        "number_operands": 39,
        "number_operators_unique": 2,
        "number_operands_unique": 36,
        "cloc": 8,
        "loc": 22,
        "lloc": 14,
        "mi": 98.59,
        "mIwoC": 58.38,
        "commentWeight": 40.21,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 0,
        "relativeDataComplexity": 2,
        "relativeSystemComplexity": 2,
        "totalStructuralComplexity": 0,
        "totalDataComplexity": 4,
        "totalSystemComplexity": 4,
        "package": "App\\AdventureGame\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 0,
        "instability": 0,
        "numberOfUnitTests": 1,
        "violations": {}
    },
    {
        "name": "App\\Card\\DeckOfCards",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "isCompleteDeck",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 2,
        "nbMethods": 2,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 2,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 2,
        "ccn": 1,
        "ccnMethodMax": 1,
        "externals": [
            "App\\Card\\CardHand"
        ],
        "parents": [
            "App\\Card\\CardHand"
        ],
        "implements": [],
        "lcom": 2,
        "length": 20,
        "vocabulary": 13,
        "volume": 74.01,
        "difficulty": 5.14,
        "effort": 380.62,
        "level": 0.19,
        "bugs": 0.02,
        "time": 21,
        "intelligentContent": 14.39,
        "number_operators": 8,
        "number_operands": 12,
        "number_operators_unique": 6,
        "number_operands_unique": 7,
        "cloc": 0,
        "loc": 15,
        "lloc": 15,
        "mi": 61.12,
        "mIwoC": 61.12,
        "commentWeight": 0,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 4,
        "relativeDataComplexity": 0.33,
        "relativeSystemComplexity": 4.33,
        "totalStructuralComplexity": 8,
        "totalDataComplexity": 0.67,
        "totalSystemComplexity": 8.67,
        "package": "App\\Card\\",
        "pageRank": 0.03,
        "afferentCoupling": 1,
        "efferentCoupling": 1,
        "instability": 0.5,
        "numberOfUnitTests": 4,
        "violations": {}
    },
    {
        "name": "App\\Card\\CardGraphic",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getAsString",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 2,
        "nbMethods": 2,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 2,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 2,
        "ccn": 1,
        "ccnMethodMax": 1,
        "externals": [
            "App\\Card\\Card"
        ],
        "parents": [
            "App\\Card\\Card"
        ],
        "implements": [],
        "lcom": 2,
        "length": 112,
        "vocabulary": 109,
        "volume": 758.04,
        "difficulty": 0.51,
        "effort": 389.55,
        "level": 1.95,
        "bugs": 0.25,
        "time": 22,
        "intelligentContent": 1475.1,
        "number_operators": 1,
        "number_operands": 111,
        "number_operators_unique": 1,
        "number_operands_unique": 108,
        "cloc": 6,
        "loc": 19,
        "lloc": 13,
        "mi": 93.64,
        "mIwoC": 55.4,
        "commentWeight": 38.23,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 1,
        "relativeDataComplexity": 1,
        "relativeSystemComplexity": 2,
        "totalStructuralComplexity": 2,
        "totalDataComplexity": 2,
        "totalSystemComplexity": 4,
        "package": "App\\Card\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 1,
        "instability": 1,
        "numberOfUnitTests": 2,
        "violations": {}
    },
    {
        "name": "App\\Card\\Card",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "convertCardNumberToString",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "draw",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getValue",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getAsString",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getColor",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 6,
        "nbMethods": 5,
        "nbMethodsPrivate": 1,
        "nbMethodsPublic": 4,
        "nbMethodsGetter": 1,
        "nbMethodsSetters": 0,
        "wmc": 13,
        "ccn": 9,
        "ccnMethodMax": 5,
        "externals": [],
        "parents": [],
        "implements": [],
        "lcom": 1,
        "length": 115,
        "vocabulary": 30,
        "volume": 564.29,
        "difficulty": 9.5,
        "effort": 5360.78,
        "level": 0.11,
        "bugs": 0.19,
        "time": 298,
        "intelligentContent": 59.4,
        "number_operators": 39,
        "number_operands": 76,
        "number_operators_unique": 6,
        "number_operands_unique": 24,
        "cloc": 27,
        "loc": 92,
        "lloc": 65,
        "mi": 77.18,
        "mIwoC": 39.98,
        "commentWeight": 37.21,
        "kanDefect": 0.64,
        "relativeStructuralComplexity": 1,
        "relativeDataComplexity": 2.75,
        "relativeSystemComplexity": 3.75,
        "totalStructuralComplexity": 6,
        "totalDataComplexity": 16.5,
        "totalSystemComplexity": 22.5,
        "package": "App\\Card\\",
        "pageRank": 0.45,
        "afferentCoupling": 3,
        "efferentCoupling": 0,
        "instability": 0,
        "numberOfUnitTests": 51,
        "violations": {}
    },
    {
        "name": "App\\Card\\CardHand",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "add",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "remove",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "shuffle",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getCount",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getValues",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getStrings",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getColors",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "draw",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 9,
        "nbMethods": 9,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 9,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 16,
        "ccn": 8,
        "ccnMethodMax": 4,
        "externals": [
            "App\\Card\\Card",
            "App\\Card\\Card"
        ],
        "parents": [],
        "implements": [],
        "lcom": 1,
        "length": 71,
        "vocabulary": 13,
        "volume": 262.73,
        "difficulty": 11.56,
        "effort": 3036.01,
        "level": 0.09,
        "bugs": 0.09,
        "time": 169,
        "intelligentContent": 22.74,
        "number_operators": 19,
        "number_operands": 52,
        "number_operators_unique": 4,
        "number_operands_unique": 9,
        "cloc": 25,
        "loc": 93,
        "lloc": 68,
        "mi": 77.99,
        "mIwoC": 42.01,
        "commentWeight": 35.98,
        "kanDefect": 1.28,
        "relativeStructuralComplexity": 9,
        "relativeDataComplexity": 1.33,
        "relativeSystemComplexity": 10.33,
        "totalStructuralComplexity": 81,
        "totalDataComplexity": 12,
        "totalSystemComplexity": 93,
        "package": "App\\Card\\",
        "pageRank": 0.17,
        "afferentCoupling": 2,
        "efferentCoupling": 1,
        "instability": 0.33,
        "numberOfUnitTests": 8,
        "violations": {}
    },
    {
        "name": "App\\Game21\\Player",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "addCard",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getHandAsString",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getHandValues",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getHandColors",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getHandCount",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 6,
        "nbMethods": 6,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 6,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 6,
        "ccn": 1,
        "ccnMethodMax": 1,
        "externals": [
            "App\\Card\\CardHand",
            "App\\Card\\Card"
        ],
        "parents": [],
        "implements": [],
        "lcom": 1,
        "length": 17,
        "vocabulary": 5,
        "volume": 39.47,
        "difficulty": 3.67,
        "effort": 144.73,
        "level": 0.27,
        "bugs": 0.01,
        "time": 8,
        "intelligentContent": 10.77,
        "number_operators": 6,
        "number_operands": 11,
        "number_operators_unique": 2,
        "number_operands_unique": 3,
        "cloc": 29,
        "loc": 60,
        "lloc": 31,
        "mi": 100.18,
        "mIwoC": 56.16,
        "commentWeight": 44.03,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 25,
        "relativeDataComplexity": 0.72,
        "relativeSystemComplexity": 25.72,
        "totalStructuralComplexity": 150,
        "totalDataComplexity": 4.33,
        "totalSystemComplexity": 154.33,
        "package": "App\\Game21\\",
        "pageRank": 0.1,
        "afferentCoupling": 2,
        "efferentCoupling": 2,
        "instability": 0.5,
        "numberOfUnitTests": 21,
        "violations": {}
    },
    {
        "name": "App\\Game21\\Game21",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "addCardDeck",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "addPlayer",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getCurrentPlayerInQueue",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getNextPlayerInQueue",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getPlayerHand",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "drawNewCard",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "computeHandTotal",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getHandTotal",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "checkWinStatus",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "returnWinnerAndloser",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 11,
        "nbMethods": 10,
        "nbMethodsPrivate": 2,
        "nbMethodsPublic": 8,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 1,
        "wmc": 33,
        "ccn": 24,
        "ccnMethodMax": 9,
        "externals": [
            "App\\Card\\DeckOfCards",
            "App\\Game21\\Player",
            "App\\Game21\\Player",
            "App\\Game21\\Player"
        ],
        "parents": [],
        "implements": [],
        "lcom": 1,
        "length": 320,
        "vocabulary": 59,
        "volume": 1882.45,
        "difficulty": 31.79,
        "effort": 59849.5,
        "level": 0.03,
        "bugs": 0.63,
        "time": 3325,
        "intelligentContent": 59.21,
        "number_operators": 95,
        "number_operands": 225,
        "number_operators_unique": 13,
        "number_operands_unique": 46,
        "cloc": 52,
        "loc": 204,
        "lloc": 152,
        "mi": 61.49,
        "mIwoC": 26.25,
        "commentWeight": 35.24,
        "kanDefect": 1.97,
        "relativeStructuralComplexity": 121,
        "relativeDataComplexity": 0.71,
        "relativeSystemComplexity": 121.71,
        "totalStructuralComplexity": 1331,
        "totalDataComplexity": 7.83,
        "totalSystemComplexity": 1338.83,
        "package": "App\\Game21\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 2,
        "instability": 1,
        "numberOfUnitTests": 2,
        "violations": {}
    },
    {
        "name": "App\\Game21\\Bank",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 1,
        "nbMethods": 1,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 1,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 1,
        "ccn": 1,
        "ccnMethodMax": 1,
        "externals": [
            "App\\Game21\\Player"
        ],
        "parents": [
            "App\\Game21\\Player"
        ],
        "implements": [],
        "lcom": 1,
        "length": 1,
        "vocabulary": 1,
        "volume": 0,
        "difficulty": 0,
        "effort": 0,
        "level": 2,
        "bugs": 0,
        "time": 0,
        "intelligentContent": 0,
        "number_operators": 0,
        "number_operands": 1,
        "number_operators_unique": 0,
        "number_operands_unique": 1,
        "cloc": 4,
        "loc": 12,
        "lloc": 8,
        "mi": 209.99,
        "mIwoC": 171,
        "commentWeight": 38.99,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 1,
        "relativeDataComplexity": 0,
        "relativeSystemComplexity": 1,
        "totalStructuralComplexity": 1,
        "totalDataComplexity": 0,
        "totalSystemComplexity": 1,
        "package": "App\\Game21\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 1,
        "instability": 1,
        "numberOfUnitTests": 1,
        "violations": {}
    },
    {
        "name": "App\\Entity\\Item",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "getId",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getName",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setName",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getDescription",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setDescription",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getImage",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setImage",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getRoom",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setRoom",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 9,
        "nbMethods": 0,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 0,
        "nbMethodsGetter": 5,
        "nbMethodsSetters": 4,
        "wmc": 0,
        "ccn": 1,
        "ccnMethodMax": 0,
        "externals": [],
        "parents": [],
        "implements": [],
        "lcom": 0,
        "length": 38,
        "vocabulary": 10,
        "volume": 126.23,
        "difficulty": 3.13,
        "effort": 394.48,
        "level": 0.32,
        "bugs": 0.04,
        "time": 22,
        "intelligentContent": 40.39,
        "number_operators": 13,
        "number_operands": 25,
        "number_operators_unique": 2,
        "number_operands_unique": 8,
        "cloc": 8,
        "loc": 57,
        "lloc": 49,
        "mi": 75.7,
        "mIwoC": 48.28,
        "commentWeight": 27.42,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 0,
        "relativeDataComplexity": 9.44,
        "relativeSystemComplexity": 9.44,
        "totalStructuralComplexity": 0,
        "totalDataComplexity": 85,
        "totalSystemComplexity": 85,
        "package": "App\\Entity\\",
        "pageRank": 0.04,
        "afferentCoupling": 1,
        "efferentCoupling": 0,
        "instability": 0,
        "numberOfUnitTests": 16,
        "violations": {}
    },
    {
        "name": "App\\Entity\\Room",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "getId",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getName",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setName",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getDescription",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setDescription",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getImage",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setImage",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getNorth",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setNorth",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getSouth",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setSouth",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getEast",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setEast",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getWest",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setWest",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getInspect",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setInspect",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 17,
        "nbMethods": 0,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 0,
        "nbMethodsGetter": 9,
        "nbMethodsSetters": 8,
        "wmc": 0,
        "ccn": 1,
        "ccnMethodMax": 0,
        "externals": [],
        "parents": [],
        "implements": [],
        "lcom": 0,
        "length": 73,
        "vocabulary": 14,
        "volume": 277.94,
        "difficulty": 4,
        "effort": 1111.75,
        "level": 0.25,
        "bugs": 0.09,
        "time": 62,
        "intelligentContent": 69.48,
        "number_operators": 25,
        "number_operands": 48,
        "number_operators_unique": 2,
        "number_operands_unique": 12,
        "cloc": 12,
        "loc": 101,
        "lloc": 89,
        "mi": 65.68,
        "mIwoC": 40.23,
        "commentWeight": 25.45,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 0,
        "relativeDataComplexity": 17.47,
        "relativeSystemComplexity": 17.47,
        "totalStructuralComplexity": 0,
        "totalDataComplexity": 297,
        "totalSystemComplexity": 297,
        "package": "App\\Entity\\",
        "pageRank": 0.04,
        "afferentCoupling": 1,
        "efferentCoupling": 0,
        "instability": 0,
        "numberOfUnitTests": 17,
        "violations": {}
    },
    {
        "name": "App\\Entity\\Book",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "getId",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setId",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getIsbn",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setIsbn",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getTitle",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setTitle",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getAuthor",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setAuthor",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getImage",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setImage",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 10,
        "nbMethods": 0,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 0,
        "nbMethodsGetter": 5,
        "nbMethodsSetters": 5,
        "wmc": 0,
        "ccn": 1,
        "ccnMethodMax": 0,
        "externals": [],
        "parents": [],
        "implements": [],
        "lcom": 0,
        "length": 44,
        "vocabulary": 10,
        "volume": 146.16,
        "difficulty": 3.63,
        "effort": 529.85,
        "level": 0.28,
        "bugs": 0.05,
        "time": 29,
        "intelligentContent": 40.32,
        "number_operators": 15,
        "number_operands": 29,
        "number_operators_unique": 2,
        "number_operands_unique": 8,
        "cloc": 8,
        "loc": 62,
        "lloc": 54,
        "mi": 73.33,
        "mIwoC": 46.92,
        "commentWeight": 26.41,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 0,
        "relativeDataComplexity": 10.5,
        "relativeSystemComplexity": 10.5,
        "totalStructuralComplexity": 0,
        "totalDataComplexity": 105,
        "totalSystemComplexity": 105,
        "package": "App\\Entity\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 0,
        "instability": 0,
        "numberOfUnitTests": 1,
        "violations": {}
    },
    {
        "name": "App\\Entity\\Product",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "getId",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getName",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setName",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getValue",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setValue",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 5,
        "nbMethods": 0,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 0,
        "nbMethodsGetter": 3,
        "nbMethodsSetters": 2,
        "wmc": 0,
        "ccn": 1,
        "ccnMethodMax": 0,
        "externals": [],
        "parents": [],
        "implements": [],
        "lcom": 0,
        "length": 19,
        "vocabulary": 6,
        "volume": 49.11,
        "difficulty": 3,
        "effort": 147.34,
        "level": 0.33,
        "bugs": 0.02,
        "time": 8,
        "intelligentContent": 16.37,
        "number_operators": 7,
        "number_operands": 12,
        "number_operators_unique": 2,
        "number_operands_unique": 4,
        "cloc": 6,
        "loc": 35,
        "lloc": 29,
        "mi": 86.04,
        "mIwoC": 56.12,
        "commentWeight": 29.92,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 0,
        "relativeDataComplexity": 5.4,
        "relativeSystemComplexity": 5.4,
        "totalStructuralComplexity": 0,
        "totalDataComplexity": 27,
        "totalSystemComplexity": 27,
        "package": "App\\Entity\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 0,
        "instability": 0,
        "numberOfUnitTests": 1,
        "violations": {}
    }
]