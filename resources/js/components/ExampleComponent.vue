<template>
    <div class="d-flex w-100 justify-center align-center bg-blue elevation-5" style="height: 100vh">
        <v-card width="400" class="mx-auto pa-5">
            <v-card-title class="px-0 pb-3">
                Registration
            </v-card-title>
            <v-form fast-fail @submit.prevent>
                <v-text-field
                    v-model="fullName"
                    label="Full name"
                    :rules="fullNameRules"
                ></v-text-field>

                <v-select
                    v-model="country"
                    label="Country"
                    item-title="name"
                    :items="countries"
                >
                    <template v-slot:selection="{ item, index }">
                        <span class="mr-2">
                            {{ item.raw.flag }} {{ item.raw.name }}
                        </span>
                    </template>
                    <template v-slot:item="{ props, item }">
                        <v-list-item
                            v-bind="props"
                        >
                            <template v-slot:prepend>
                                <span class="mr-2">
                                    {{ item.raw.flag }}
                                </span>
                            </template>
                        </v-list-item>
                    </template>
                </v-select>

                <v-text-field
                    v-model="phoneNumber"
                    :prefix="getCountryCode"
                    label="Phone number"
                    @input="formatPhoneNumber"
                >

                </v-text-field>

                <v-text-field
                    v-model="email"
                    label="Email"
                    :rules="emailRules"
                ></v-text-field>

                <v-btn type="submit" block class="mt-2 bg-blue">Register</v-btn>
            </v-form>
        </v-card>
    </div>
</template>

<script>
import countries from '../data/countries.json'

export default {
    data: () => ({
        countries,
        selectedCountry: {
            name:"Eswatini",
            flag:"\ud83c\uddf8\ud83c\uddff",
            idd:"+268"
        },
        country: 'Eswatini',
        fullName: '',
        fullNameRules: [
            value => {
                if (value?.length > 2) return true
                return 'Full name must be at least 2 characters.'
            },
        ],

        phoneNumber: '',

        email: '',
        emailRules: [
            value => {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) return true
                return 'Email is not properly formatted'
            }
        ],
    }),
    computed: {
      getCountryCode() {
          return this.selectedCountry.idd
      }
    },
    methods: {
        formatPhoneNumber(event) {
            const format = '00 000-00-00'
            let res = ''
            let value = event.target.value;
            value = value.replace(/[^0-9]+/g, '')

            console.log('Replaced: ', value)

            for (let i = 0; i < value.length && i < 9; i ++) {
                if (i === 2) {
                    res += ' '
                } else if (i === 5) {
                    res += '-'
                } else if (i === 7) {
                    res += '-'
                }
                res += value.charAt(i)
            }
            this.phoneNumber = res
        }
    },
    watch: {
        country(value) {
            this.selectedCountry = this.countries.filter(it => {
              return it.name === value
            })[0]
        },
    },
}
</script>

<style>
.v-text-field__prefix {
    color: #2196f3 !important;
}
</style>
