<template>
    <div v-if="state">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <select2 id="select-dropdown" name="" class="form-control" v-model="filterCounty">
                    <option value="">All Counties</option>
                    <option v-for="county in counties" :value="county">{{ county }}</option>
                </select2>
            </div>

            <div>
                {{ checkedZips.length }}/{{ zipCodes.length }} zip code(s)
            </div>
        </div>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th><input type="checkbox" :checked="allDisplayedChecked" @change="checkAll"></th>
                    <th>Zip Code</th>
                    <th>County</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="zipCode in zipCodesToDisplay">
                    <td><input :id="`zip-code${zipCode.zip}`" type="checkbox" @change="toggleCheck(zipCode)" :checked="zipCodeChecked(zipCode)"></td>
                    <td><label :for="`zip-code${zipCode.zip}`">{{ zipCode.zip }}</label></td>
                    <td><label :for="`zip-code${zipCode.zip}`">{{ zipCode.county_name }}</label></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import allZipCodes from '../allZipCodes';
import Select2 from './Select2';

export default {
    components: {Select2},
    props: ['state'],
    data() {
        return {
            allZipCodes: allZipCodes,
            filterCounty: '',
            checkedZips: [],
        }
    },
    computed: {
        allDisplayedChecked() {
            for (let zipCode of this.zipCodesToDisplay) {
                if (! this.checkedZips.includes(zipCode.zip)) {
                    return false;
                }
            }

            return true;
        },
        zipCodes() {
            return this.allZipCodes.filter(zipCode => zipCode.state_id === this.state.code);
        },
        zipCodesToDisplay() {
            let result = this.zipCodes;

            if (this.filterCounty) {
                result = result.filter(i => i.county_name === this.filterCounty);
            }

            result = result.sort((a, b) => {
                if (a.county_name < b.county_name) {
                    return -1;
                }

                if (a.county_name > b.county_name) {
                    return 1;
                }

                return 0;
            });

            return result;
        },
        counties() {
            let result = [];

            for (let zipCode of this.zipCodes) {
                if (result.includes(zipCode.county_name)) {
                    continue;
                }

                result.push(zipCode.county_name);
            }

            result = result.sort();

            return result;
        }
    },
    methods: {
        toggleCheck(zipCode) {
            if (this.checkedZips.includes(zipCode.zip)) {
                this.checkedZips.splice(this.checkedZips.indexOf(zipCode.zip), 1);
            } else {
                this.checkedZips.push(zipCode.zip);
            }

            this.fireChangedEvent();
        },
        checkAll() {
            if (! this.allDisplayedChecked) {
                for (let zipCode of this.zipCodesToDisplay) {
                    if (! this.checkedZips.includes(zipCode.zip)) {
                        this.checkedZips.push(zipCode.zip)
                    }
                }
            } else {
                for (let zipCode of this.zipCodesToDisplay) {
                    if (this.checkedZips.includes(zipCode.zip)) {
                        this.checkedZips.splice(this.checkedZips.indexOf(zipCode.zip), 1);
                    }
                }
            }

            this.fireChangedEvent();
        },
        zipCodeChecked(zipCode) {
            return this.checkedZips.includes(zipCode.zip);
        },
        fireChangedEvent() {
            this.$emit('change', this.checkedZips);
        }
    },
    created() {
        if (this.state.all_zips) {
            this.checkedZips = this.zipCodes.map(i => i.zip);
        } else {
            this.checkedZips = this.state.zips;
        }
    }
}
</script>

<style scoped>
    .table label {
        cursor: pointer;
        display: block;
    }
</style>
