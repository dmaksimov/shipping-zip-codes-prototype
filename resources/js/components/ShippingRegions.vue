<template>
    <div>
        <div v-for="state in states">
            <label>
                <input type="checkbox" v-model="state.checked">
                {{ state.name }}
            </label>
            <a v-if="state.checked" href="#" @click.prevent="editStateZips(state)">
                <span v-if="state.all_zips">(All zip codes)</span>
                <span v-else>({{ countChecked(state) }} / {{ zipCodesForState(state) }})</span>
            </a>
        </div>

        <b-modal id="zip-codes-modal" :title="this.activeState ? `${this.activeState.name} Zip Codes` : ''">
            <zip-codes :state="activeState" @change="updateStateZips"></zip-codes>
        </b-modal>
    </div>
</template>

<script>
import allZipCodes from '../allZipCodes';
import ZipCodes from './ZipCodes';

export default {
    components: {ZipCodes},
    data() {
        return {
            activeState: null,
            allZipCodes: allZipCodes,
            states: [
                {
                    "id": 1,
                    "checked": false,
                    "code": "AL",
                    "name": "Alabama",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 2,
                    "checked": false,
                    "code": "AK",
                    "name": "Alaska",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 3,
                    "checked": false,
                    "code": "AZ",
                    "name": "Arizona",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 4,
                    "checked": false,
                    "code": "AR",
                    "name": "Arkansas",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 5,
                    "checked": false,
                    "code": "CA",
                    "name": "California",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 6,
                    "checked": false,
                    "code": "CO",
                    "name": "Colorado",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 7,
                    "checked": false,
                    "code": "CT",
                    "name": "Connecticut",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 8,
                    "checked": false,
                    "code": "DE",
                    "name": "Delaware",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 9,
                    "checked": false,
                    "code": "DC",
                    "name": "District of Columbia",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 10,
                    "checked": false,
                    "code": "FL",
                    "name": "Florida",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 11,
                    "checked": false,
                    "code": "GA",
                    "name": "Georgia",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 12,
                    "checked": false,
                    "code": "HI",
                    "name": "Hawaii",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 13,
                    "checked": false,
                    "code": "ID",
                    "name": "Idaho",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 14,
                    "checked": false,
                    "code": "IL",
                    "name": "Illinois",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 15,
                    "checked": false,
                    "code": "IN",
                    "name": "Indiana",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 16,
                    "checked": false,
                    "code": "IA",
                    "name": "Iowa",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 17,
                    "checked": false,
                    "code": "KS",
                    "name": "Kansas",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 18,
                    "checked": false,
                    "code": "KY",
                    "name": "Kentucky",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 19,
                    "checked": false,
                    "code": "LA",
                    "name": "Louisiana",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 20,
                    "checked": false,
                    "code": "ME",
                    "name": "Maine",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 21,
                    "checked": false,
                    "code": "MD",
                    "name": "Maryland",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 22,
                    "checked": false,
                    "code": "MA",
                    "name": "Massachusetts",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 23,
                    "checked": false,
                    "code": "MI",
                    "name": "Michigan",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 24,
                    "checked": false,
                    "code": "MN",
                    "name": "Minnesota",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 25,
                    "checked": false,
                    "code": "MS",
                    "name": "Mississippi",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 26,
                    "checked": false,
                    "code": "MO",
                    "name": "Missouri",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 27,
                    "checked": false,
                    "code": "MT",
                    "name": "Montana",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 28,
                    "checked": false,
                    "code": "NE",
                    "name": "Nebraska",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 29,
                    "checked": false,
                    "code": "NV",
                    "name": "Nevada",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 30,
                    "checked": false,
                    "code": "NH",
                    "name": "New Hampshire",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 31,
                    "checked": false,
                    "code": "NJ",
                    "name": "New Jersey",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 32,
                    "checked": false,
                    "code": "NM",
                    "name": "New Mexico",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 33,
                    "checked": false,
                    "code": "NY",
                    "name": "New York",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 34,
                    "checked": false,
                    "code": "NC",
                    "name": "North Carolina",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 35,
                    "checked": false,
                    "code": "ND",
                    "name": "North Dakota",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 36,
                    "checked": false,
                    "code": "OH",
                    "name": "Ohio",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 37,
                    "checked": false,
                    "code": "OK",
                    "name": "Oklahoma",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 38,
                    "checked": false,
                    "code": "OR",
                    "name": "Oregon",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 39,
                    "checked": false,
                    "code": "PA",
                    "name": "Pennsylvania",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 40,
                    "checked": false,
                    "code": "RI",
                    "name": "Rhode Island",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 41,
                    "checked": false,
                    "code": "SC",
                    "name": "South Carolina",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 42,
                    "checked": false,
                    "code": "SD",
                    "name": "South Dakota",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 43,
                    "checked": false,
                    "code": "TN",
                    "name": "Tennessee",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 44,
                    "checked": false,
                    "code": "TX",
                    "name": "Texas",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 45,
                    "checked": false,
                    "code": "UT",
                    "name": "Utah",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 46,
                    "checked": false,
                    "code": "VT",
                    "name": "Vermont",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 47,
                    "checked": false,
                    "code": "VA",
                    "name": "Virginia",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 48,
                    "checked": false,
                    "code": "WA",
                    "name": "Washington",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 49,
                    "checked": false,
                    "code": "WV",
                    "name": "West Virginia",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 50,
                    "checked": false,
                    "code": "WI",
                    "name": "Wisconsin",
                    "all_zips": true,
                    "zips": []
                },
                {
                    "id": 51,
                    "checked": false,
                    "code": "WY",
                    "name": "Wyoming",
                    "all_zips": true,
                    "zips": []
                }
            ],
        };
    },
    computed: {

    },
    methods: {
        zipCodesForState(state) {
            return this.allZipCodes.filter(i => i.state_id == state.code).length;
        },
        countChecked(state) {
            if (state.all_zips) {
                return this.zipCodesForState(state);
            }

            return state.zips.length;
        },
        editStateZips(state) {
            this.activeState = state;

            this.$bvModal.show('zip-codes-modal')
        },
        updateStateZips(zips) {
            console.log('update state zips');
            this.activeState.zips = zips;
            if (this.zipCodesForState(this.activeState) === zips.length) {
                this.activeState.all_zips = true;
                this.activeState.zips = [];
            } else {
                this.activeState.all_zips = false;
                this.activeState.zips = zips;
            }
        }
    }
}
</script>
