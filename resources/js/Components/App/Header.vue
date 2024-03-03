<script setup>
import Navbar from '@/Components/App/Navbar.vue';
import HeaderBubble from '@/Components/Svg/HeaderBubble.vue';
</script>

<template>
    <header class="w-full border relative">
        <div class="max-w-7xl relative mx-auto border border-red-400 ">
            <HeaderBubble class="absolute top-0 right-0 w-3/4 z-0" />

            <Navbar class="sticky z-10" />
            <div class="w-full flex mt-4">
                <div class="w-[42%] z-10">
                    <h2 class="mt-6 text-gray-600 text-5xl">Saia do aperto de forma prática, rápida e segura!</h2>
                    <p class="my-6 text-2xl text-gray-600">Não realizamos <s>consulta de crédito</s>. <br> Clique no
                        botão abaixo para conferir as ofertas e valores disponíveis agora mesmo.</p>
                    <button class="cssbuttons-io-button">
                        SOLICITAR VALOR
                        <div class="icon">
                            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                    </button>

                </div>
                <div class="w-[58%] relative z-10 ">
                    s
                </div>
            </div>


        </div>
    </header>
</template>


<style scoped>
.cssbuttons-io-button {
    background: #2961fc;
    color: white;
    font-family: inherit;
    padding: 0.35em;
    padding-left: 1.2em;
    font-size: 17px;
    font-weight: 500;
    border-radius: 0.9em;
    border: none;
    letter-spacing: 0.05em;
    display: flex;
    align-items: center;
    box-shadow: inset 0 0 1.6em -0.6em #0fc7ff;
    overflow: hidden;
    position: relative;
    height: 2.8em;
    padding-right: 3.3em;
    cursor: pointer;
}

.cssbuttons-io-button .icon {
    background: white;
    margin-left: 1em;
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 2.2em;
    width: 2.2em;
    border-radius: 0.7em;
    box-shadow: 0.1em 0.1em 0.6em 0.2em #0ab1ff;
    right: 0.3em;
    transition: all 0.3s;
}

.cssbuttons-io-button:hover .icon {
    width: calc(100% - 0.6em);
}

.cssbuttons-io-button .icon svg {
    width: 1.1em;
    transition: transform 0.3s;
    color: #2482fd;
}

.cssbuttons-io-button:hover .icon svg {
    transform: translateX(0.1em);
}

.cssbuttons-io-button:active .icon {
    transform: scale(0.95);
}
</style>