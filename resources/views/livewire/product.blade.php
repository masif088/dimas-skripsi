<div class="row">
    <div class="col-lg-12">
        <x-data-income-outcome
            componentId="some"
            title="$product->title"
            title1="Produk Terjual"
            :value1="$data['amount']"
            title2="Omzet Produk"
            :value2="$data['total']"
            btn1="Potongan karyawan"
            btnColor1="btn-danger"
            btn2="CSV"
            btnColor2="btn-success"
            link1=""
            link2="#"
            :data1="$incomePreviewMonth"
            dataTitle1="Bulan Lalu"
            :data2="$incomeThisMonth"
            dataTitle2="Bulan Ini"
            :categories="$category"
        />
    </div>
</div>
