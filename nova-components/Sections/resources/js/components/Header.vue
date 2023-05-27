<template>
    <a-card>
        <a-descriptions>
            <a-descriptions-item label="Instructor">
                {{ load.teacher.name }}
            </a-descriptions-item>
            <a-descriptions-item label="Subject Name">
                {{ load.subject.name }}
            </a-descriptions-item>
            <a-descriptions-item label="Section">
                {{ load.description }}
            </a-descriptions-item>
        </a-descriptions>
    </a-card>
</template>

<script>
export default {
    props: ['load'],
    data() {
        return {

        }
    }
}
</script>
