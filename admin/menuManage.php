<?php

?>
<div class="container-fluid" style="margin-top: 98px;">
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
				<form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
					<div class="card mb-3">
						<div class="card-header" style="background-color: #2A403D; color: white;">
							Create New Item
						</div>
						<div class="card-body">
							<div class="form-group">
								<label class="control-label">Name: </label>
								<input type="text" class="form-control" name="name" required>
							</div>
							<div class="form-group">
								<label class="control-label">Description: </label>
								<textarea cols="30" rows="3" class="form-control" name="description" required></textarea>
							</div>
							<div class="form-group">
								<label class="control-label">Price</label>
								<input type="number" class="form-control" name="price" required min="1">
							</div>	
							<div class="form-group">
								<label class="control-label">Category: </label>
								<select name="categoryId" id="categoryId" class="custom-select browser-default" required>
									<option hidden disabled selected value>None</option>
									<?php
									$catsql = "SELECT * FROM `categories`"; 
									$catresult = mysqli_query($conn, $catsql);
									while($row = mysqli_fetch_assoc($catresult)){
										$catId = $row['categorieId'];
										$catName = $row['categorieName'];
										echo '<option value="' .$catId. '">' .$catName. '</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="image" class="control-label">Image</label>
								<input type="file" name="image" id="image" accept=".jpg" class="form-control" required style="border:none;">
								<small id="Info" class="form-text text-muted mx-3">Please upload .jpg file.</small>
							</div>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="mx-auto">
									<button type="submit" name="createItem" class="btn btn-sm btn-primary" style="background-color:#2A403D; color:white; border:none"> Create </button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover mb-0">
							<thead style="background-color: #2A403D; color: white;">
								<tr>
									<th class="text-center" style="width: 7%;">Cat. Id</th>
									<th class="text-center">Img</th>
									<th class="text-center" style="width: 58%;">Item Detail</th>
									<th class="text-center" style="width: 18%;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql = "SELECT * FROM `bouquet`";
								$result = mysqli_query($conn, $sql);
								while($row = mysqli_fetch_assoc($result)){
									$bouquetId = $row['bouquetId'];
									$bouquetName = $row['bouquetName'];
									$bouquetPrice = $row['bouquetPrice'];
									$bouquetDesc = $row['bouquetDesc'];
									$bouquetCategorieId = $row['bouquetCategorieId'];

									echo '<tr>
											<td class="text-center">' .$bouquetCategorieId. '</td>
											<td>
												<img src="/bouquetElviOnline/img/bouquet-'.$bouquetId. '.jpg" alt="image for this item" width="150px" height="150px">
											</td>
											<td>
												<p>Name : <b>' .$bouquetName. '</b></p>
												<p>Description : <b class="truncate">' .$bouquetDesc. '</b></p>
												<p>Price : <b>' .$bouquetPrice. '</b></p>
											</td>
											<td class="text-center">
												<div class="row mx-auto" style="width: 112px;">
													<button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#updateItem' .$bouquetId. '" style="background-color: #748B6F; color: white; border:none;">Edit</button>
													<form action="partials/_menuManage.php" method="POST">
														<button name="removeItem" class="btn btn-sm btn-danger" style="margin-left: 9px;" style="background-color: #E44E5D; color: white; border:none;">Delete</button>
														<input type="hidden" name="bouquetId" value="'.$bouquetId. '">
													</form>
												</div>
											</td>
										</tr>';
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	
</div>

<?php
$bouquetsql = "SELECT * FROM `bouquet`";
$bouquetResult = mysqli_query($conn, $bouquetsql);
while($bouquetRow = mysqli_fetch_assoc($bouquetResult)){
	$bouquetId = $bouquetRow['bouquetId'];
	$bouquetName = $bouquetRow['bouquetName'];
	$bouquetPrice = $bouquetRow['bouquetPrice'];
	$bouquetCategorieId = $bouquetRow['bouquetCategorieId'];
	$bouquetDesc = $bouquetRow['bouquetDesc'];
?>
<!-- Modal -->
<div class="modal fade" id="updateItem<?php echo $bouquetId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateItem<?php echo $bouquetId; ?>" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #2A403D; color: white;">
				<h5 class="modal-title" id="updateItem<?php echo $bouquetId; ?>">Item Id: <?php echo $bouquetId; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
					<div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
						<div class="form-group col-md-8">
							<b><label for="image">Image</label></b>
							<input type="file" name="itemimage" id="itemimage" accept=".jpg" class="form-control" required style="border:none;" onchange="document.getElementById('itemPhoto').src = window.URL.createObjectURL(this.files[0])">
							<small id="Info" class="form-text text-muted mx-3">Please upload .jpg file.</small>
							<input type="hidden" id="bouquetId" name="bouquetId" value="<?php echo $bouquetId; ?>">
							<button type="submit" class="btn btn-success my-1" name="updateItemPhoto" style="background-color: #2A403D; color: white; border:none;">Update Img</button>
						</div>
						<div class="form-group col-md-4">
							<img src="/bouquetElviOnline/img/bouquet-<?php echo $bouquetId; ?>.jpg" id="itemPhoto" name="itemPhoto" alt="item image" width="100" height="100">
						</div>
					</div>
				</form>
				<form action="partials/_menuManage.php" method="post">
					<div class="text-left my-2">
						<b><label for="name">Name</label></b>
						<input class="form-control" id="name" name="name" value="<?php echo $bouquetName; ?>" type="text" required>
					</div>
					<div class="text-left my-2 row">
						<div class="form-group col-md-6">
							<b><label for="price">Price</label></b>
							<input class="form-control" id="price" name="price" value="<?php echo $bouquetPrice; ?>" type="number" min="1" required>
						</div>
						<div class="form-group col-md-6">
							<b><label for="catId">Category Id</label></b>
							<input class="form-control" id="catId" name="catId" value="<?php echo $bouquetCategorieId; ?>" type="number" min="1" required>
						</div>
					</div>
					<div class="text-left my-2">
						<b><label for="desc">Description</label></b>
						<textarea class="form-control" id="desc" name="desc" rows="2" required minlength="6"><?php echo $bouquetDesc; ?></textarea>
					</div>
					<input type="hidden" id="bouquetId" name="bouquetId" value="<?php echo $bouquetId; ?>">
					<button type="submit" class="btn btn-success" name="updateItem" style="background-color: #2A403D; color: white; border:none;">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
