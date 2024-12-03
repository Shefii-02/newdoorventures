
<i role="button" title="Search Near Me" @click="getLocation()"  class=" mdi mdi-map-marker-radius-outline fs-3 text-primary"></i>
<i role="button" title="Search by Voice" class=" mdi mdi-microphone fs-3 text-primary openModal"></i>
<input type="hidden"  name="lat" class="lat mt-2" >
<input type="hidden" name="long" class="long  mt-2">
<p id="error-message" class="text-danger mt-2"></p>