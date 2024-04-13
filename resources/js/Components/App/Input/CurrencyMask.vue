<template>
    <input v-model.lazy="price" v-money="money" @keyup="handleUpdate()"
        @input="$emit('update:modelValue', $event.target.value)" maxlength="10" class="input input-bordered"
        :class="{ 'border:none focus:outline focus:outline-red-400 animate-shake animate-duration-[300ms]': this.cleanPrice > maxValue }" />
    <small v-if="this.cleanPrice > maxValue" class="my-2 text-red-500">Valor disponível: <b>{{ maskedValue
            }}</b></small>
    <small v-else class="text-gray-500">Você pagará <b>{{ maskedInterest }}</b> ao final.</small>

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
        cleanPrice() {
            this.cleanPrice = this.price.replace(/R\$ /g, '').replace(/\./g, '').replace(',', '.');
        },

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
        }
    },



    directives: { money: VMoney }
}
</script>
