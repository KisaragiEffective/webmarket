<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>kisaragi shop's profile</title>
		<style>
			.profile {
				width: 100%;
				border-collapse: collapse;
			}

			.profile tr {
				border-bottom: solid 2px white;
			}

			.profile tr:last-child {
				border-bottom: none;
			}

			.profile th {
				position: relative;
				text-align: left;
				width: 30%;
				background-color: #52c2d0;
				color: white;
				text-align: center;
				padding: 10px 0;
			}

			.profile th:after {
				display: block;
				content: "";
				width: 0px;
				height: 0px;
				position: absolute;
				top:calc(50% - 10px);
				right:-10px;
				border-left: 10px solid #52c2d0;
				border-top: 10px solid transparent;
				border-bottom: 10px solid transparent;
			}

			.profile td {
				text-align: left;
				width: 70%;
				text-align: center;
				background-color: #eee;
				padding: 10px 0;
			}
		</style>
	</head>
	<body>
		<div>
			<table class="profile">
				<tbody>
					{{-- TODO: 動的生成 --}}
					<tr>
						<th>会社名</th>
						<td>如月商店</td>
					</tr>
					<tr>
						<th>創業</th>
						{{-- dummy --}}
						<td>2020年1月32日</td>
					</tr>
					<tr>
						<th>従業員数</th>
						<td>1人</td>
					</tr>
					<tr>
						<th>Discord Tag</th>
						<td>@I like nanahira's songs, for example, "Baseline yatteru?"#12345</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</html>