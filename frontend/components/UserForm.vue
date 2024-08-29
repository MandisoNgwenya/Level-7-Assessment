<template>
  <v-card>
    <v-col cols="12" md="12">
      <v-text-field :label="'Name'" v-model="form.name"></v-text-field>
    </v-col>
    <v-col cols="12" md="12">
      <v-text-field
        :label="'Email'"
        type="email"
        v-model="form.email"
      ></v-text-field>
    </v-col>
    <v-col cols="12" md="12">
      <v-text-field
        :label="'Password'"
        type="password"
        v-on:input="validatePasswordStrength"
        v-model="form.password"
        id="password"
      ></v-text-field>
    </v-col>
    <v-col cols="12" md="12">
      <v-text-field
        :label="'Confirm Password'"
        type="password"
        v-on:input="validatePassword"
        v-if="isValidPassword"
        id="password_confirmation"
        v-model="form.password_confirmation"
      ></v-text-field>
      <v-text-field
        :label="'Confirm Password'"
        type="password"
        v-else
        id="password_confirmation"
        disabled
        v-model="form.password_confirmation"
      ></v-text-field>

      <span
        v-if="this.errorBag.password_confirmation"
        class="pass-validation"
        :class="{
          'pass-validation-pass': !this.errorBag.password_confirmation,
        }"
      >
        {{ errorBag.password_confirmation }}</span
      >
    </v-col>

    <v-col cols="12" md="12">
      <p
        class="pass-validation"
        :class="{ 'pass-validation-pass': form.password.length > 8 }"
      >
        Longer than 8 characters
        <v-btn
          v-if="form.password.length > 8"
          class="'pass-validation pass-validation-pass"
          icon="mdi-check"
          variant="text"
        ></v-btn>
        <v-btn
          v-else
          class="pass-validation-fail"
          icon="mdi-check"
          variant="text"
        ></v-btn>
      </p>
      <p
        class="pass-validation"
        :class="{ 'pass-validation-pass': passwordStrength.has_uppercase }"
      >
        Has a capital letter
        <v-btn
          v-if="passwordStrength.has_uppercase"
          class="'pass-validation pass-validation-pass"
          icon="mdi-check"
          variant="text"
        ></v-btn>
        <v-btn
          v-else
          class="pass-validation-fail"
          icon="mdi-check"
          variant="text"
        ></v-btn>
      </p>
      <p
        class="pass-validation"
        :class="{ 'pass-validation-pass': passwordStrength.has_lowercase }"
      >
        Has a lowercase letter
        <v-btn
          v-if="passwordStrength.has_lowercase"
          class="'pass-validation pass-validation-pass"
          icon="mdi-check"
          variant="text"
        ></v-btn>
        <v-btn
          v-else
          class="pass-validation-fail"
          icon="mdi-check"
          variant="text"
        ></v-btn>
      </p>
      <p
        class="pass-validation"
        :class="{ 'pass-validation-pass': passwordStrength.has_number }"
      >
        Has a number
        <v-btn
          v-if="passwordStrength.has_number"
          class="'pass-validation pass-validation-pass"
          icon="mdi-check"
          variant="text"
        ></v-btn>
        <v-btn
          v-else
          class="pass-validation-fail"
          icon="mdi-check"
          variant="text"
        ></v-btn>
      </p>
      <p
        class="pass-validation"
        :class="{ 'pass-validation-pass': passwordStrength.has_special }"
      >
        Has a special character
        <v-btn
          v-if="passwordStrength.has_special"
          class="'pass-validation pass-validation-pass"
          icon="mdi-check"
          variant="text"
        ></v-btn>
        <v-btn
          v-else
          class="pass-validation-fail"
          icon="mdi-check"
          variant="text"
        ></v-btn>
      </p>
    </v-col>

    <v-col cols="12" md="12">
      <div class="mt-1 mb-5">
        <v-btn width="100%" @click="registerUser()"> Save </v-btn>
      </div>
    </v-col>
  </v-card>
</template>

<script>
export default {
  //   props: ["form"],
  components: {},
  data: () => ({
    form: {
      id: 0,
      password_confirmation: "",
      password: "",
      email: "",
      name: "",
    },
    view_password: false,

    errorBag: {
      name: false,
      email: false,
      password: false,
      password_confirmation: false,
    },

    isValidPassword: false,
    passwordStrength: {
      message: "",
      has_number: false,
      has_lowercase: false,
      has_uppercase: false,
      has_special: false,
    },
  }),
  watch: {},
  async mounted() {},
  async created() {},
  methods: {
    validatePasswordStrength() {
      this.passwordStrength = {
        has_number: /\d/.test(this.form.password),
        has_lowercase: /[a-z]/.test(this.form.password),
        has_uppercase: /[A-Z]/.test(this.form.password),
        has_special: /[!@#\$%\^\&*\)\(+=._-]/.test(this.form.password),
      };

      if (
        this.passwordStrength.has_lowercase &&
        this.passwordStrength.has_number &&
        this.passwordStrength.has_uppercase &&
        this.passwordStrength.has_special
      ) {
        this.isValidPassword = true;
      } else {
        this.isValidPassword = false;
      }

      this.validatePassword();
    },

    validatePassword() {
      console.log(this.form.password, this.form.password_confirmation);
      if (this.form.password !== this.form.password_confirmation) {
        this.errorBag = {};
        this.errorBag.password_confirmation =
          "Password confirmation does not match.";
      } else {
        this.errorBag = false;
      }
    },
    async registerUser() {
      this.response = await $fetch("http://127.0.0.1:8000/api/register", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: { form: this.form },
      });
    },
  },
};
</script>

<style scoped>
.pass-validation {
  font-size: 15px;
}

.pass-validation {
  color: #717b85;
}

.pass-validation-fail {
  color: #eb0029;
}

.pass-validation-pass {
  color: #0fa140;
}
</style>