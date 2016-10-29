<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url();?>">Bootstrap Form</a>
        </div>
        <ul class="nav navbar-nav">

            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url()."form/view_kpi";?>">KPI
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url()."form/view_kpi";?>">View KPIs</a></li>
                    <li><a href="<?php echo base_url()."form/add_kpi";?>">Add KPI</a></li>
                    <li><a href="<?php echo base_url()."form/add_kpi_category";?>">Add Category</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url()."form/view_kra";?>">KRA
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url()."form/view_kra/";?>">View KRAs</a></li>
                    <li><a href="<?php echo base_url()."form/add_kra";?>">Add KRA</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url()."form/view_employee";?>">Employee
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url()."form/view_employee/";?>">View Employees</a></li>
                    <li><a href="<?php echo base_url()."form/add_employee";?>">Add Employee</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
<?php
/**
 * Created by PhpStorm.
 * User: Umair
 * Date: 10/2/2016
 * Time: 6:24 PM
 */
