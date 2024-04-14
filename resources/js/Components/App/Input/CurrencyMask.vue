<template>
    <input v-bind="$attrs" v-model.lazy="price" v-money="money" @keyup="handleUpdate()" @input="updateModelValue"
        maxlength="10" class="input input-bordered"
        :class="{ 'border:none focus:outline focus:outline-red-400 animate-shake animate-duration-[300ms]': parseFloat(this.cleanPrice) > maxValue }" />
    <small v-if="parseFloat(this.cleanPrice) > maxValue" class="my-2 text-red-500">Máximo: <b>{{ maskedValue
            }}</b> disponível para você.</small>
    <small v-else class="text-gray-500 my-2">Você pagará <b>{{ maskedInterest }}</b> ao final.</small>
</template>

<script>
import { VMoney } from 'v-money'

export default {
    props: {
        maxValue: Number,
        Interest: Number,
    },
    emits: ['update:modelValue'],
    data() {
        return {
            price: '',
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                precision: 2,
            },
            cleanPrice: 0,
        }
    },

    computed: {
        // cleanPriceComputed() {
        //     this.cleanPrice = this.price.replace(/R\$ /g, '').replace(/\./g, '').replace(',', '.');
        // },

        maskedValue() {
            // Formata o valor de maxValue como um valor monetário
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL',
                minimumFractionDigits: 2
            }).format(this.maxValue);
        },

        maskedInterest() {
            var value = this.cleanPrice * (this.Interest / 100);
            // Formata o valor de maxValue como um valor monetário
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL',
                minimumFractionDigits: 2
            }).format(value + parseFloat(this.cleanPrice));
        }
    },
    methods: {
        handleUpdate: function () {
            this.cleanPrice = this.price.replace(/R\$ /g, '').replace(/\./g, '').replace(',', '.');
        },
        updateModelValue(event) {
            this.$emit('update:modelValue', this.cleanPrice);
        }
    },


    inheritAttrs: false, // Evitar propagacao de atributos nao prop
    directives: { money: VMoney }
}
</script>
