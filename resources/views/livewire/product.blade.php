<div class="row">
    <div class="col-lg-12">
        <x-data-income-outcome
            componentId="some"
            :title="$product->title"
            title1="Produk Terjual"
            value1="Rp. {{ number_format($data['amount']) }}"
            title2="Omzet Produk"
            value2="Rp. {{ number_format($data['total']) }}"
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
            :data3="$income2PreviewMonth"
            dataTitle3="2 Bulan Lalu"
            :categories="$category"

        />
    </div>
</div>
