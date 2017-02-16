<?php if($preview == 0){ ?>
<li>
	<h6>
	<input type="number" min ="1" max="1000" name="users" value="<?php echo $users; ?>" class="plan-entry"  data-plans="users"/>
	</h6>
	<p> Users </p>
</li>
<li>
	<h6>
	<input type="number" min ="1" max="1000" name="jobsites" value="<?php echo $jobsites; ?>" class="plan-entry" data-plans="jobsites" />
	</h6>
	<p> Jobsites </p>
</li>
<li>
	<h6>
	<input type="number" min ="1" max="1000" name="forms" value="<?php echo $forms; ?>"  class="plan-entry" data-plans="forms" />
	</h6>
	<p> Forms </p>
</li>

<li>
	<h6> - </h6>
	<p> Submissions </p>
</li>
<?php } else if($preview == 1) { ?>
<li>
	<h6><?php echo $users; ?></h6>
	<p> Users </p>
</li>
<li>
	<h6><?php echo $jobsites; ?></h6>
	<p> Jobsites </p>
</li>
<li>
	<h6><?php echo $forms; ?></h6>
	<p> Forms </p>
</li>

<li>
	<h6> - </h6>
	<p> Submissions </p>
</li>
<?php } ?>