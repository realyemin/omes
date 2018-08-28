 <tr><td align="right">Doğum Tarihiniz</td>
													<td>
                                                        <table>
																<tr>
                                                                    <td>
                                                                           Gün :   
																		<select name="FormGun" required class="form-control" style="color:#f00;">
																			<option>Seçiniz</option>
																		<?php for($gun=1; $gun<=31; $gun++){ ?>
																		<option value='<?php echo $gun < 10 ? "0".$gun : $gun ?>'><?php echo $gun < 9 ? "0".$gun : $gun ?></option>
																		<?php } ?>
																		</select>	
																	</td>
																	<td>	
                                                                           Ay :    <select name="FormAy" required class="form-control" style="color:#f00;">
																		   <option>Seçiniz</option>
																		<?php for($ay=1; $ay<=12; $ay++){ ?>
																		<option value='<?php echo $ay < 10 ? "0".$ay : $ay ?>'><?php echo $ay < 9 ? "0".$ay : $ay ?></option>
																		<?php } ?>
																		</select>
																	</td>
																	<td>
                                                                           Yıl :   <select name='FormYil' required class="form-control" style="color:#f00;">
																		   <option>Seçiniz</option>
																		<?php for($yil=1920; $yil<=date('Y', strtotime('-6 year')); $yil++){ ?>
																		<option value='<?php echo $yil; ?>'><?php echo $yil; ?></option>
																		<?php } ?>
																		</select>
																	</td>
                                                                </tr>
                                                        </table>
                                                    </td>
                                                </tr>