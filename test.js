            
            
            function calculateBillingSummary() {
                let subTotal = 0;
                cart.forEach(item => {
                    // float নিশ্চিত করতে parseFloat ব্যবহার করা ভালো
                    subTotal += (parseFloat(item.price) || 0) * (parseInt(item.quantity) || 0);
                });

                // ডিসকাউন্ট ইনপুট রিড করা
                let discountInput = document.getElementById('discount_input');
                let discount = discountInput ? parseFloat(discountInput.value) || 0 : 0;

                let grandTotal = subTotal - discount;
                if (grandTotal < 0) grandTotal = 0;

                // ডান পাশের স্প্যানগুলোতে মান পুশ করা (আইডি চেক করে নেওয়া নিরাপদ)
                let subTotalSpan = document.getElementById('summary_sub_total');
                let grandTotalSpan = document.getElementById('summary_grand_total');
                
                if (subTotalSpan) subTotalSpan.innerText = '৳' + subTotal.toFixed(2);
                if (grandTotalSpan) grandTotalSpan.innerText = '৳' + grandTotal.toFixed(2);
                
                // 🛒 POS স্পিড ইউএক্স ট্রিকস (সঠিক লজিক)
                let paidInput = document.getElementById('paid_amount');
                if (paidInput) {
                    let currentPaid = parseFloat(paidInput.value) || 0;
                    // যদি ইনপুট খালি থাকে, ০ থাকে, অথবা গ্র্যান্ড টোটালের চেয়ে বেশি হয়ে যায় (ডিসকাউন্ট পরিবর্তনের কারণে)
                    if (paidInput.value === "" || currentPaid === 0 || currentPaid > grandTotal) {
                        paidInput.value = grandTotal.toFixed(2);
                    }
                }
                
                calculateDue();
            }

            /**
             * ⚠️ ৮. ডিউ (Due) বা বাকি টাকা লাইভ ক্যালকুলেশন অ্যালার্ট বক্স মেথড
             */
            function calculateDue() {
                let grandTotalSpan = document.getElementById('summary_grand_total');
                if (!grandTotalSpan) return; // স্প্যান না থাকলে কোড থামিয়ে দেবে

                let grandTotalText = grandTotalSpan.innerText.replace('৳', '').replace(/,/g, '');
                let grandTotal = parseFloat(grandTotalText) || 0;
                
                let paidInput = document.getElementById('paid_amount');
                let paidAmount = paidInput ? parseFloat(paidInput.value) || 0 : 0;
                
                let dueAmount = grandTotal - paidAmount;

                let dueAlertBox = document.getElementById('due_alert_box');
                let dueSpan = document.getElementById('summary_due_amount');

                // ডিউ ০ এর নিচে নামলে বা ০ হলে বক্স হাইড হবে
                if (dueAmount > 0) {
                    if (dueAlertBox) dueAlertBox.classList.remove('d-none');
                    if (dueSpan) dueSpan.innerText = '৳' + dueAmount.toFixed(2);
                } else {
                    if (dueAlertBox) dueAlertBox.classList.add('d-none');
                }
            }

            // 💵 ৭. সেফটি চেকসহ রিয়েল-টাইমে আপডেট হওয়ার ইভেন্ট লিসেনার
            let discountField = document.getElementById('discount_input');
            if (discountField) {
                discountField.addEventListener('input', calculateBillingSummary);
            }

            let paidField = document.getElementById('paid_amount');
            if (paidField) {
                paidField.addEventListener('input', calculateDue);
            }
