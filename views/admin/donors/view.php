<link rel="stylesheet" href="../public/CSS/table/table-styles.css">
<?php

/** @var $model \app\models\donorModel */

$CCs = \app\models\ccModel::getCCs();

?>

<style>

    @media print {

        @page {
            size: landscape;
        }

        .sidenav, .profile, .search-filter {
            display: none;
        }

        .main {
            width: 100vw;
            left: 0;
            height: 100%;
            overflow: visible;
        }

        tbody td:last-child {
            display: none;
        }

    }


</style>

<?php $profile = new \app\core\components\layout\profileDiv();

$profile->profile();

$profile->notification();

$profile->end(); ?>


<?php $headerDiv = new \app\core\components\layout\headerDiv(); ?>

<?php $headerDiv->heading("Donors"); ?>

<?php $headerDiv->end(); ?>


<!-- Inforgraphic Cards Layout -->
<?php $infoDiv = new \app\core\components\layout\infoDiv([1,2,1]);

?>

<?php
$statData = $model->getDonorStats();
?>
<div class="stat-box-2-h">
    <div class="stat-card">
        <span class="stat-title">
Total Registrations       </span>
        <span class="stat-value">
<?php
echo $statData['0'] + $statData['1'];
?>
        </span>
        <span class="stat-movement inc">
            <i class="material-icons">groups</i>
        </span>

    </div>
    <div class="stat-card">
                <span class="stat-title">
Verified Donors    </span>
        <span class="stat-value">
            <?php
            echo $statData['1'];
            ?>

        </span>
        <span class="stat-movement inc">
            <i class="material-icons">verified_user</i>
        </span>

    </div>
</div>

<?php
// First Block of Statistics

?>
<!--Second Long Div with Bar Chart-->
<?php $infoDiv->chartDivStart(); ?>
<div class="chart-container">
    <p>Registrations in  <?php echo date(
            "Y"); ?></p>
    <canvas id="totalRegChart" height="120px"></canvas>
</div>

<?php
$chartData2 = $model->getDonorRegMonthly();
?>

<script>
    const monthData = <?php echo json_encode($chartData2); ?>;
</script>
<script src="../public/JS/charts/admin/donor/totalRegChart.js"></script>

<?php $infoDiv->chartDivEnd();

$infoDiv->chartDivStart();
//?>
<div class="chart-container">
    <p>Donors by Category</p>
    <canvas id="donorCategoryChart" height="240px"></canvas>
</div>

<?php
$chartData1 = $model->getDonorbyCategory();
?>
<script>
    const donorData = <?php echo json_encode($chartData1); ?>;
</script>
<script src="../public/JS/charts/admin/donor/donorCategoryChart.js"></script>

<!-- Summary of ALl Statistics in this div-->
<?php
$infoDiv->chartDivEnd();

$infoDiv->end(); ?>



<?php $searchDiv = new \app\core\components\layout\searchDiv();

$searchDiv->filterDivStart();

$searchDiv->filterBegin();

$filter = \app\core\components\form\form::begin('', '');
$filter->dropDownList($model,"Community center","cc",$CCs,"ccFilter");
$filter->dropDownList($model,"Type","type",['Individual' => 'Individual','Organization' => 'Organization'],"typeFilter");
$filter->end();

$searchDiv->filterEnd();

$searchDiv->sortBegin();

$sort = \app\core\components\form\form::begin('', '');
$sort->checkBox($model,"Registered Date","registeredDate","registeredDateSort");
$sort->end();

$searchDiv->sortEnd();

$searchDiv->filterDivEnd();

$searchDiv->search();

echo "<button class='btn-cta-primary' id='donorPrint'>Print</button>";

$searchDiv->end(); ?>


<div id="donorTable" class="content">

    <?php
    $donors = $model->retrieveWithJoin('users','userID',[],[],'donorID');

    //adding relevant ceommunity center for each donee
    foreach ($donors as $key => $donor) {
        $donors[$key]['cc'] = $CCs[$donor['ccID']];
    }

    $headers = ["Username",'Registered Date','Community Center',"Contact Number","Type"];
    $arrayKeys = ["username",'registeredDate','cc','contactNumber','type',['','View','./donors/individual/view',['donorID'],'donorID']];

    $individualTable = new \app\core\components\tables\table($headers,$arrayKeys);

    $individualTable->displayTable($donors);
    ?>

</div>

<script type="module" src="../public/JS/admin/donor/view.js"></script>

<script>

    window.onload = function () {
        document.getElementById("donorPrint").addEventListener("click", function() {
            window.print();
        })
    }

</script>