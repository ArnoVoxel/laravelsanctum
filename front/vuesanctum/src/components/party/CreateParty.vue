<template>
  <div>
    <div class="grid place-content-right">
      <button
        class="btn rounded px-2 mb-1 hover:bg-amber-900"
        @click="open =!open"
      >New Party</button>
    </div>
    <Teleport to="body">
      <div
        v-if="open"
        class="modal card grid grid-cols-2 gap-4 p-3 text-black place-content-center"
      >

        <!-- FIESTA LABEL -->
          <div >nom de fête</div>
          <div >
            <input
              class="form-input px-4 py-3 rounded-full"
              v-model="label"
              type="text"
              placeholder="fiesta label"
            />
            <div v-if="errors.label">{{ errors.label[0] }}</div>
          </div>

        <!-- FIESTA DESCRIPTION -->
        <div >description</div>
        <div >
          <input
            class="form-input px-4 py-3"
            v-model="description"
            type="text"
            placeholder="fiesta description"
          />
          <div v-if="errors.description">{{ errors.description[0] }}</div>
        </div>

        <!-- FIESTA DATE -->
        <div >date</div>
        <div >
          <input
            class="form-input px-4 py-3 rounded-full"
            v-model="date"
            type="date"
          />
          <div v-if="errors.date">{{ errors.date[0] }}</div>
        </div>

        <!-- FIESTA MEMBERS -->
        <div >members</div>
        <div v-if="table_members.length != 0">{{ table_members }}</div>
        <div class="card grid grid-row-3 grid-cols-4 gap-4">
          <button v-if="!createMember" class="rounded-full col-span-1" @click="createMember = true"><font-awesome-icon :icon="['fas', 'plus']" /></button>
          <input
            v-if="createMember"
            class="col-span-3 form-input px-4 py-3 rounded"
            v-model="member.name"
            type="text"
          />
          <input
            v-if="createMember"
            class="col-span-3 form-input px-4 py-3 rounded"
            v-model="member.email"
            type="text"
          />
          <button v-if="createMember" class="rounded-full col-span-1" @click="addMember()"><font-awesome-icon :icon="['fas', 'save']" /></button>
          <div v-if="errors.member">{{ errors.member[0] }}</div>
        </div>

        <button
          class="btn rounded-full px-2 mb-1"
          @click="storeParty"
        >Save the Date !</button>
        <button
          class="btn rounded-full px-2 mb-1"
          @click="open = !open"
        >annuler</button>

      </div>
    </Teleport>
  </div>

</template>

<script>
import axios from "axios";

export default {
  name: "PartyCreate",
  data() {
    return {
      open: false,
      createMember: false,
      label: "",
      description: "",
      date: "",
      member: {
        name: "",
        email: "",
      },
      table_members: [],
      errors: { label: null, description: null, date: null },
    };
  },
  created() {
    //
  },
  mounted() {
    //
  },
  methods: {
    storeParty() {
      axios
        .post("http://127.0.0.1:8000/api/parties", {
          label: this.label,
          description: this.description,
          date: this.date,
          table_members: this.table_members,
        })
        .then((response) => {
          this.$emit("partyCreated", response.data);
          this.label = "";
      this.description = "";
      this.date = "";
      this.member = {
        name: "",
        email: "",
      };
      this.table_members = [];
          this.open = false;
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
    addMember() {
      this.table_members.push(this.member);
      this.member = { name: "", email: "" };
      this.createMember = false;
      console.log(this.table_members);
    },
    closeForm() {
      this.open = false;
      this.errors = { label: null, description: null, date: null };
    },
  },

};
</script>