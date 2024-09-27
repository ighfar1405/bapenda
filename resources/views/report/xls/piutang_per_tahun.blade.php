<table style="margin: 5px 0px 10px;">
    <tbody>
        <tr>
            <th class="text-center" style="width: 1%">NO.</th>
            <th class="text-center">Uraian</th>
            <th class="text-center">Nominal</th>
            <th class="text-center">Jumlah Bayar</th>
            <th class="text-center">Piutang 2024 <br/> sesudah koreksi</th>
            <th class="text-center">Pelunasan atas saldo <br/> Piutang 2024</th>
            <th class="text-center">Sisa Piutang <br/> Tahun 2024</th>
            <th class="text-center">Penambahan Piutang <br/> Tahun 2024</th>
            <th class="text-center">Saldo Piutang 2024</th>
        </tr>

        <tr>
            <td class="borderLeft borderBottom text-center">1</td>
            <td class="borderLeft borderBottom text-center">2</td>
            <td class="borderLeft borderBottom text-center">3</td>
            <td class="borderLeft borderBottom text-center">4</td>
            <td class="borderLeft borderBottom text-center">5=3+4</td>
            <td class="borderLeft borderBottom text-center">6</td>
            <td class="borderLeft borderBottom text-center">7=5-6</td>
            <td class="borderLeft borderBottom text-center">8</td>
            <td class="borderLeft borderBottom text-center">9=7+8</td>
        </tr>

        @for($i = 2014; $i <= 2024; $i++)
        <tr>
            <td class="borderLeft text-center"></td>
            <td class="borderLeft">Piutang <?= $i ?></td>
            <td class="borderLeft text-right">900.000,00</td>
            <td class="borderLeft text-right">900.000,00</td>
            <td class="borderLeft text-right">900.000,00</td>
            <td class="borderLeft text-right">900.000,00</td>
            <td class="borderLeft text-right">900.000,00</td>
            <td class="borderLeft text-right">900.000,00</td>
            <td class="borderLeft text-right">900.000,00</td>
        </tr>
        @endfor

        <!-- Blank Row -->
        <tr>
            @for ($i = 0; $i < 9; $i++)
            <td class="borderLeft borderBottom"></td>
            @endfor
        </tr>

        <tr>
            <td class="borderLeft text-center"></td>
            <td class="borderLeft">Jumlah</td>
            <td class="borderLeft font-weight-bold text-right">300.000,00</td>
            <td class="borderLeft font-weight-bold text-right">400.000,00</td>
            <td class="borderLeft font-weight-bold text-right">500.000,00</td>
            <td class="borderLeft font-weight-bold text-right">600.000,00</td>
            <td class="borderLeft font-weight-bold text-right">700.000,00</td>
            <td class="borderLeft font-weight-bold text-right">800.000,00</td>
            <td class="borderLeft font-weight-bold text-right">100.000,00</td>
        </tr>
    </tbody>
</table>
