<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 */
?>
<?= $this->Form->create($employee) ?>
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Employee</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <?= $this->Form->label(ucwords('first_name'))?>
                                        <?= $this->Form->input('first_name',[
                                            'class'=> 'form-control',
                                            'placeholder' => 'Enter First Name'])?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <?= $this->Form->label(ucwords('middle_name'))?>
                                        <?= $this->Form->input('middle_name',[
                                            'class'=> 'form-control',
                                            'placeholder' => 'Enter Middle Name'])?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <?= $this->Form->label(ucwords('last_name'))?>
                                        <?= $this->Form->input('last_name',[
                                            'class'=> 'form-control',
                                            'placeholder' => 'Enter Last Name'])?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                        <?= $this->Form->label(ucwords('department'))?>
                                        <?= $this->Form->select('department_id',$departments,[
                                            'class'=> 'form-control',
                                            'empty' => 'Select Department',
                                            ])?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                        <?= $this->Form->label(ucwords('date_of_birth'))?>
                                        <?= $this->Form->input('date_of_birth',[
                                            'type' => 'date',
                                            'class'=> 'form-control',
                                            ])?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                        <?= $this->Form->label(ucwords('status'))?>
                                        <?= $this->Form->select('status',[ 
                                            'Single' => 'Single', 
                                            'Married' => 'Married', 
                                            'Divorced' => 'Divorced', 
                                            'Widowed' => 'Widowed'],[
                                            'empty' => 'Select Status',
                                            'class'=> 'form-control',
                                            'placeholder' => ' Enter Status',
                                            ])?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <?= $this->Form->label(ucwords('place_of_birth'))?>
                                        <?= $this->Form->input('place_of_birth',[
                                            'class'=> 'form-control',
                                            'placeholder' => ' Enter Place of Birth',
                                            ])?>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-2">
                                    <button type="submit"
                                        class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset"
                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->Form->end() ?>
<!-- // Basic multiple Column Form section end -->