<span ng-controller="ctrlDashboard">
	<section class="row" style="background-color:#fff">
		<br/>
		<br/>
		<ul class="breadcrumbs">
			<li><a href="<?php echo site_url('m/dashboard');?>">Dashboard</a></li>
			<li class="current"><a href="#">My Test</a></li>
		</ul>
		<span style="text-align:center">
			<h1>My Test</h1>
			<p>Management tests that you make here. Manage open and close time and a variety of questions or cases.</p>
			<br/>
		</span>
		<center>
			<div class="large-12 columns">
				<dl class="tabs" data-tab>
					<dd style="width:33.33%;"><a href="#newtest" style="background-color:#fff;color:#008CBA" href="#">+ New Test</a></dd>
					<dd style="width:33.33%" class="active"><a ng-click="getMyTest('open')" href="#courseList">Open Test (<?php echo $totalopentest;?>)</a></dd>
					<dd style="width:33.33%"><a ng-click="getMyTest('clossed')" href="#courseList">Closed Test (<?php echo $totalclosedtest;?>)</a></dd>
				</dl>
			</div>
		</center>
	</section>
	<section id="completion">
		<center>
			<div class="row">
				<div class="large-12 collapse" columns>
					<!-- skill completion -->
					<div class="row">
						<div class="tabs-content">
							<!-- new test -->
							<div class="content" id="newtest">
								<p>Completing Data</p>
								<form name="NewTest" ng-submit="newTest()">
									<div class="row">
										<div class="small-12 columns">
											<div class="row">
												<div class="small-2 columns">
													<label for="testname" class="right inline">Test Name</label>
												</div>
												<div class="small-9 columns">
													<input type="text" id="testname" ng-model="new.testName" required>
												</div>
											</div>
											<div class="row">
												<div class="small-2 columns">
													<label for="notes" class="right inline">Notes To Participant</label>
												</div>
												<div class="small-9 columns">
													<div data-alert class="alert-box info">
														Will show to participant before start a test.
														<a href="#" class="close">&times;</a>
													</div>
													<textarea style="min-height:200px" type="text" id="notes" row="4" ng-model="new.testNotes" required></textarea>
												</div>
											</div>
											<br/>
											<div class="row">
												<div class="small-2 columns">
													<label for="organization" class="right inline">Organization</label>
												</div>
												<div class="small-9 columns">
													<input type="text" id="organization"  ng-model="new.organization">
												</div>
											</div>
											<div class="row">
												<div class="small-2 columns">
													<label for="testemail" class="right inline">Email Contact</label>
												</div>
												<div class="small-9 columns">
													<input type="email" id="testemail"  ng-model="new.testEmail">
												</div>
											</div>
											<div class="row">
												<div class="small-2 columns">
													<label for="unique" class="right inline">Unique Name</label>
												</div>
												<div class="small-9 columns">
													<div data-alert class="alert-box info">
														Make unik test link like "my-test" without space.
														<a href="#" class="close">&times;</a>
													</div>
													<input ng-keyup="checkUniqueLink()" type="text" id="unique" ng-model="new.testUniqueLink" placeholder="input custom unique name without space">
													<small ng-hide="alertUniqueBox" class="error">{{alertUniqueText}}</small>
												</div>
											</div>
											<div class="row">
												<div class="small-2 columns">
													<label for="open" class="right inline">Open Test</label>
												</div>
												<div class="small-9 columns">
													<input type="datetime-local" id="open" ng-model="new.testOpen">
												</div>
											</div>
											<div class="row">
												<div class="small-2 columns">
													<label for="close" class="right inline">Close Test</label>
												</div>
												<div class="small-9 columns">
													<input type="datetime-local" id="close" ng-model="new.testClose">
												</div>
											</div>
											<div class="row">
												<div class="small-2 columns">
													<label for="type" class="right inline">Test Type</label>
												</div>
												<div class="small-9 columns">
													<div data-alert class="alert-box info">
														More options available soon.
														<a href="#" class="close">&times;</a>
													</div>
													<select id="type" ng-model="new.testType='private'" required>
														<option value="public">Public</option>
														<option value="private">Private</option>
													</select>
												</div>
											</div>
											<br/>
											<div class="row">
												<div class="small-2 columns">
													<p></p>
												</div>
												<div class="small-9 columns">
													<label style="float:left"><input type="checkbox" required> i have read terms of use</label>
													<br/>
													<br/>
													<button ng-hide="btnSubmitBox" style="float:left" class="button" type="submit">Next Step</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							<!-- course list -->
							<div class="content active" id="courseList">
								<!-- loader -->
								<div ng-hide="listLoader" data-alert class="alert-box info">{{listLoaderText}}</div>
								<!-- list -->
								<a ng-repeat="list in testList" href="<?php echo site_url('m/managetest/')?>/{{list.idTest}}">
									<div class="joinmateri row">
										<div class="small-5 columns"><p><strong>{{list.testName}}</strong></p></div>
										<div class="small-5 columns">
											<p><strong>open-close</strong><br/>{{list.testOpen}} - {{list.testClose}}</p>
										</div>
										<div style="float:left" class="small-1 columns"><p><strong>Step</strong><br/>20</p></div>
										<div style="float:left" class="small-1 columns"><p><strong>Participant</strong><br/>20</p></div>
									</div>
								</a>
							</div>
							<!-- end of course list -->
							<!-- start my test-->
							<div class="content" id="mytest">
								<p>my test</p>
							</div>
							<!-- end of my test -->
						</div>
					</div>
				</div>
			</div>
		</center>
	</section>
</span>
