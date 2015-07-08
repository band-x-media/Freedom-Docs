---
title: Explorer
---

<div class="container">

	<div class="paper">

		<div class="row">

			<div class="col-md-2">

				<h4>API Explorer</h4>

			</div>

			<div class="col-md-3">

				<div class="form-group material with-icon">
					<i class="icon material-icons">open_in_browser</i>
					<input type="text" class="form-control" placeholder="API Domain" value="https://api.freedo.mx">
				</div>

			</div>

			<div class="col-md-4">

				<div class="form-group material with-icon">
					<i class="icon material-icons">vpn_key</i>
					<input type="text" class="form-control" placeholder="App Key" value="947676ad6ebdd0394278c8b0c79c7d49">
				</div>

			</div>

			<div class="col-md-2">

				<div class="breather"></div>

				<a class="btn btn-sm btn-default">
					Debug
				</a>

			</div>

			<div class="clearfix "></div>

			<hr />

			<div class="breather"></div>

			<div class="col-md-3">

				<div class="bg-grey bg-50">

				<div class="form-group material">
					<select>
						<option>GET</option>
						<option>POST</option>
					</select>
				</div>

				<div class="form-group material">
					<select>
						<option>Module</option>
					</select>
				</div>

				<div class="form-group material">
					<select>
						<option>Method</option>
					</select>
				</div>

<P>params</P>

				</div>

			</div>

			<div class="col-md-9">

				<div class="bg-light-blue bg-400">

					<p class="requestURL text-white">GET https://api.freedo.mx/module/method?appKey=947676ad6ebdd0394278c8b0c79c7d49&amp;param1=a&amp;param2=b</p>

				</div>

				<div class="bg-grey bg-100">

					<pre>{
    "status": 400,
    "message": "Application authentication failed",
    "data": null,
    "executionTime": 0
}</pre>

				</div>

				<div class="bg-light-blue bg-200">

					<p class="repsonseTimeContainer text-white">Executed in <span class="responseTime">0.3</span>s</p>

				</div>

			</div>

		</div>

	</div>

</div>
