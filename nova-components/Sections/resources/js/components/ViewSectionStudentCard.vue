<template>
    <a-card :hoverable="true" class="card" @click="$emit('click', student)">
        <a-row type="flex" justify="center">
            <a-avatar :size="100" style="font-size: 42px; text-transform: uppercase;">{{
                student.name[0] }}</a-avatar>
        </a-row>
        <a-row>
            <a-col :span="24">

                <div style="margin-top: 1em; text-align:center; line-height: 0.7;">
                    <h3 class="name">
                        {{ student.name }}
                    </h3>
                    <p class="secondary">{{ student.profile.course }}</p>
                </div>
            </a-col>
        </a-row>
    </a-card>
</template>

<script>
export default {
    props: ['student'],
}
</script>
