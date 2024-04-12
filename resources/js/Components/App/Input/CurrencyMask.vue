<template>
    <input v-model.lazy="price" v-money="money" @input="$emit('update:modelValue', $event.target.value)" maxlength="10"
        class="input input-bordered"
        :class="{ 'border:none focus:outline focus:outline-red-400 animate-shake animate-duration-[300ms]': cleanPrice > maxValue }" />
    <small v-if="cleanPrice > maxValue" class="my-2 text-red-500">Valor disponível: <b>{{ maskedValue }}</b></small>
</template>

<script>
import { VMoney } from 'v-money'

export default {
    props: {
        maxValue: Number
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
        }
    },

    computed: {
        cleanPrice() {
            return this.price.replace(/R\$ /g, '').replace(/\./g, '').replace(',', '.');
        },

        maskedValue() {
            // Formata o valor de maxValue como um valor monetário
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL',
                minimumFractionDigits: 2
            }).format(this.maxValue);
        }
    },



    directives: { money: VMoney }
}
</script>
