<script setup></script>

<template>
    <div class="wallet-header">
        <div class="balance-header w-100">
            <div class="balance-amount-header w-100 mr-3">
                <!-- Static balance value -->
                <span>₱ 1,000,000.00</span>
            </div>
            <!-- Removed refresh functionality, static icon only -->
            <div class="flex items-center justify-center mr-1">
                <i class="mdi mdi-cached text-[#fff]"></i>
            </div>
            <!-- Static wallet icon -->
            <i class="mdi mdi-wallet text-[#fff] p-2"></i>
        </div>
    </div>
</template>

<style scoped>
.wallet-header {
    display: flex;
    align-items: center;
    gap: 40px;
}

.balance-header {
    display: flex;
    background-color: #1a1c1e;
    border-radius: 8px;
    border: 1px solid grey;
}

.balance-amount-header {
    padding-left: 5px;
    color: yellow;
    display: flex;
    align-items: center;
    gap: 20px;
}

.wallet-inner {
    background-color: #363636;
    padding: 10px 15px;
    transition: 0.3s ease-in-out;
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
    caret-color: transparent;
}

.rotate {
    animation: rotate 1s linear forwards;
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>
